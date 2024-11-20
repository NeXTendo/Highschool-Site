const ctxEnrollment = document.getElementById('enrollmentChart').getContext('2d');
new Chart(ctxEnrollment, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{ 
            data: [50, 55, 60, 70, 65, 80],
            label: "Enrollment",
            borderColor: "#3182ce",
            fill: false
        }]
    }
});

const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
new Chart(ctxRevenue, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            data: [3000, 4500, 3200, 5200, 6100, 7000],
            label: "Revenue",
            backgroundColor: "#68d391"
        }]
    }
});

const ctxGraduation = document.getElementById('graduationChart').getContext('2d');
new Chart(ctxGraduation, {
    type: 'pie',
    data: {
        labels: ["Graduated", "Did Not Graduate"],
        datasets: [{
            data: [90, 10],
            backgroundColor: ["#4a5568", "#ed64a6"]
        }]
    }
});
