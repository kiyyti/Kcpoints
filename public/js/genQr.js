    document.getElementById("genqr").addEventListener("submit", function(event) {
        event.preventDefault();  // ป้องกันการ reload หน้าเว็บ

        const activity = document.getElementById("activity").value.trim();
        const score = document.getElementById("point").value.trim();

        // ตรวจสอบข้อมูลก่อนการสร้าง QR code
        if (activity === "" || score === "") {
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน'
            });
            return;  // หากกรอกไม่ครบให้หยุดการทำงาน
        }

        // แปลงข้อมูลเป็น string ที่เหมาะสม
        const maxActivityLength = 10; // จำกัดความยาวของชื่อกิจกรรม
        const qrcodeData = `กิจกรรม: ${activity.slice(0, maxActivityLength)}, คะแนน: ${score}`;

        // ล้างข้อมูล QR code เดิมก่อนสร้างใหม่
        document.getElementById("qrcode").innerHTML = "";

        // สร้าง QR code ใหม่
        QRCode.toCanvas(document.getElementById("qrcode"), qrcodeData, { width: 200 }, function (error) {
            if (error) {
                console.error("การสร้าง QR code ล้มเหลว:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'ข้อผิดพลาด',
                    text: 'ไม่สามารถสร้าง QR code ได้'
                });
            } else {
                console.log("QR code generated successfully!");
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: 'QR code ถูกสร้างแล้ว'
                });
            }
        });
    });