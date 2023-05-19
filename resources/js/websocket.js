require("./bootstrap");

// registration event
let toastLiveExample = document.getElementById("liveToast");
Echo.channel("registration-channel").listen("RegistrationEvent", (e) => {
    let data = e.user;
    document.getElementById("detail-toastr").innerText =
        data?.name + " melakukan pendaftaran akun baru";
    let toast = new bootstrap.Toast(toastLiveExample);
    if (user.role == "admin") {
        toast.show();
    }
});
