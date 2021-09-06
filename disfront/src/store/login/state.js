export default function () {
  return {
    status: '',
    token: localStorage.getItem('tokendisca') || '',
    user : {},
    pedido:[]
  }
}
