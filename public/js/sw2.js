function showError(ermessage) {
    Swal.fire({
        icon: "error",
        title: "เข้าสู่ระบบไม่สำเร็จ",
        text: ermessage
    });
}

function adminError(admessage) {
    Swal.fire({
        icon: "error",
        title: "ผิดพลาด",
        text: admessage
    });
}

function showSuccess(scmessage) {
    Swal.fire({
        icon: "success",
        title: "เข้าสู่ระบบสำเร็จ",
        text: scmessage
    });
}

function logouts() {
    Swal.fire({
        icon: "success",
        title: "ออกจากระบบเสร็จสิ้น",
        text: "คุณได้ออกจากระบบแล้ว"
        });
}


