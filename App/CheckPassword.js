var element = document.querySelector('input[id="cpw"]');
element.onchange = (e) => {
    //compare password and currend password
    const pw = e.target.value;
    const cpw = document.querySelector('input[id="pw"]').value;
    if (pw !== cpw) {
        document.getElementById("message_pwd").textContent = "Password don't match";
    } else {
        document.getElementById("message_pwd").textContent = "";
    }
};
var element = document.querySelector('input[id="pw"]');
element.onchange = (e) => {
    //compare password and currend password
    const pw = e.target.value;
    const cpw = document.querySelector('input[id="cpw"]').value;
    if (cpw === "") {
        return;
    }
    if (pw !== cpw) {
        document.getElementById("message_pwd").textContent = "Password don't match";
    } else {
        document.getElementById("message_pwd").textContent = "";
    }
};