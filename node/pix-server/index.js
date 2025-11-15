const express = require('express');
const QRCode = require('qrcode');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());

function twoDigits(n) {
  return n.toString().padStart(2, '0');
}
function formatField(id, value) {
  const len = Buffer.byteLength(String(value), 'utf8');
  return `${id}${twoDigits(len)}${value}`;
}
function buildMerchantAccount(key) {
  // Tag 00 = GUI, tag 01 = chave PIX, opcional 02 = descrição
  let s = '';
  s += formatField('00', 'BR.GOV.BCB.PIX');
  s += formatField('01', key);
  return s;
}
function buildAdditionalData(txid) {
  // Tag 05 do template 62 = txid
  return formatField('05', txid);
}
// CRC16-CCITT (initial 0xFFFF, poly 0x1021)
function crc16(buf) {
  let crc = 0xFFFF;
  for (let offset = 0; offset < buf.length; offset++) {
    crc ^= (buf[offset] << 8);
    for (let i = 0; i < 8; i++) {
      crc = (crc & 0x8000) ? ((crc << 1) ^ 0x1021) & 0xFFFF : (crc << 1) & 0xFFFF;
    }
  }
  return crc.toString(16).toUpperCase().padStart(4, '0');
}
function buildPayload({ key, merchantName = 'NOME DA LOJA', merchantCity = 'CIDADE', amount = null, txid = '***' }) {
  let payload = '';
  payload += formatField('00', '01');                // Payload Format Indicator
  payload += formatField('01', '12');                // Point of Initiation (12 = dynamic, 11 static)
  payload += formatField('26', buildMerchantAccount(key));
  payload += formatField('52', '0000');              // Merchant Category Code (default 0000)
  payload += formatField('53', '986');               // Currency BRL
  if (amount !== null) payload += formatField('54', Number(amount).toFixed(2));
  payload += formatField('58', 'BR');
  // merchant name max 25 chars, merchant city max 15
  payload += formatField('59', String(merchantName).slice(0,25));
  payload += formatField('60', String(merchantCity).slice(0,15));
  payload += formatField('62', buildAdditionalData(txid));
  // compute CRC: append 63 (tag) + "04" length placeholder before computing
  const payloadForCrc = payload + '63' + '04';
  const crc = crc16(Buffer.from(payloadForCrc, 'utf8'));
  payload += formatField('63', crc);
  return payload;
}

app.post('/api/pix', async (req, res) => {
  try {
    const { valor, idPedido, chavePix, nomeLoja, cidadeLoja } = req.body;
    if (!idPedido) return res.status(400).json({ error: 'idPedido obrigatório' });
    // chavePix: sua chave PIX (CPF/CNPJ/email/telefone/EVP). Se não passar, preciso definir default.
    const key = chavePix || process.env.PIX_KEY || '53838422848';
    const payload = buildPayload({
      key,
      merchantName: nomeLoja || 'MINHA CANTINA',
      merchantCity: cidadeLoja || 'CIDADE',
      amount: (typeof valor === 'number' ? valor : null),
      txid: String(idPedido).slice(0,25)
    });

    const qrcodeDataUrl = await QRCode.toDataURL(payload, { width: 350, margin: 2 });
    return res.json({ codigo: payload, qrcode: qrcodeDataUrl });
  } catch (err) {
    console.error(err);
    return res.status(500).json({ error: 'Erro ao gerar PIX' });
  }
});

const PORT = process.env.PORT || 4000;
app.listen(PORT, () => console.log(`PIX server running on http://localhost:${PORT}`));