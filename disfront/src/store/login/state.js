export default function () {
  return {
    status: '',
    token: localStorage.getItem('tokendisca') || '',
    user : {},
    pedido:[],
    boolimportar:false,
    boolusuarios:false,
    boolpago:false,
    boolpagorealizados:false,
    boolpagosfaltantes:false,
    boolmispagos:false,
  }
}
