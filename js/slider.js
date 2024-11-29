document.addEventListener("DOMContentLoaded", () => {
    const slider = document.querySelector(".slider");
    let currentIndex = 0;
    const images = document.querySelectorAll(".slider img");
    const intervalTime = 3000; // Tiempo entre cada cambio (en milisegundos)

    // Función para cambiar de imagen automáticamente
    const autoSlide = () => {
        currentIndex = (currentIndex + 1) % images.length;
        slider.scrollLeft = currentIndex * slider.offsetWidth;
    };

    // Configurar el intervalo automático
    setInterval(autoSlide, intervalTime);

    // Navegación con los botones
    const navButtons = document.querySelectorAll(".slider-nav a");
    navButtons.forEach((button, index) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            currentIndex = index;
            slider.scrollLeft = currentIndex * slider.offsetWidth;
        });
        
    });
});