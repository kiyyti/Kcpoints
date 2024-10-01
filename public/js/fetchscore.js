function fetchScores() {
    fetch('../../config/fetch_scores.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
    return response.json();
})
.then(data => {
    const tbody = document.querySelector('#scoreTable tbody');
    tbody.innerHTML = ''; // เคลียร์ข้อมูลเก่า
    data.forEach(row => {
        tbody.innerHTML += `<tr>
            <td>${row.fname}</td>
            <td>${row.lname}</td>
            <td>${row.point}</td>
        </tr>`;
    });
})
.catch(error => console.error('Error fetching scores:', error));
}

document.addEventListener('DOMContentLoaded', () => {
    fetchScores(); // เรียกใช้ฟังก์ชันเมื่อโหลดหน้า
    setInterval(fetchScores, 5000); // อัปเดตทุก 5 วินาที
});

