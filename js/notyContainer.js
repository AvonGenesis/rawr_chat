function errorLogin() {
    noty({"text":"The username and password you entered do not match!","layout":"top","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
}

function errorUsername() {
    noty({"text":"Please enter a username!","layout":"top","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
}

function errorPasswordNotLongEnough() {
    noty({"text":"Password must be at least 4 characters long!","layout":"top","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
}

function errorPasswordDoNotMatch() {
    noty({"text":"The password you entered do not match!","layout":"top","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
}

function successCreateUser(){
    noty({"text":"User has been successfully created, you may now log in.","layout":"top","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
}

function errorUserAlreadyExist() {
    noty({"text":"Username is already in use!","layout":"top","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
}

function successLogin(){
    noty({"text":"Successfully logged in.","layout":"top","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
}

function infoRoomClose(){
    noty({"text":"The room you were in has been closed.","layout":"top","type":"information","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
}