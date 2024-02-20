document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('loadingIndicator').style.display = 'none'
})

document.addEventListener('DOMContentLoaded', function () {
    let particles = document.querySelectorAll('.particle');

    particles.forEach(function (particle) {
        particle.style.top = Math.random() * 100 + '%';
        particle.style.left = Math.random() * 80 + '%';
    })
})



