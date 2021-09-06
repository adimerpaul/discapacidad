/*
export function someMutation (state) {
}
*/
export function auth_request(state){
  state.status = 'loading'
}
export function auth_success(state, data){
  state.status = 'success'
  state.token = data.token
  state.user = data.user
  state.boolimportar=data.user.permisos.find(permiso=>permiso.id===1)!=undefined
  state.boolusuarios=data.user.permisos.find(permiso=>permiso.id===2)!=undefined
  state.boolpago=data.user.permisos.find(permiso=>permiso.id===3)!=undefined
  state.boolpagorealizados=data.user.permisos.find(permiso=>permiso.id===4)!=undefined
  state.boolpagosfaltantes=data.user.permisos.find(permiso=>permiso.id===5)!=undefined
  state.boolmispagos=data.user.permisos.find(permiso=>permiso.id===6)!=undefined
}
export function   auth_error(state){
  state.status = 'error'
}
export function salir(state){
  state.status = ''
  state.token = ''
  state.user = ''
  state.boolimportar=false
  state.boolusuarios=false
  state.boolpago=false
  state.boolpagorealizados=false
  state.boolpagosfaltantes=false
  state.boolmispagos=false
}
