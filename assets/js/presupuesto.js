document.addEventListener("DOMContentLoaded", function() {
    const showPriceButton = document.getElementById('showPriceButton');
    const closePriceCard = document.getElementById('closePriceCard');
    const priceCard = document.getElementById('priceCard');
    const priceCardField = document.getElementById('priceCardField');
    const priceCardText = document.getElementById('priceCardText');

    priceCard.style.display = 'none';

    const randomPrices = [
        "El precio aproximado es de 1000€.",
        "El precio aproximado es de 2000€.",
        "El precio aproximado es de 3000€.",
        "El precio aproximado es de 4000€.",
        "El precio aproximado es de 5000€."
    ];

    const randomTexts = [
        "Este es un precio estimado basado en proyectos similares.",
        "El precio puede variar dependiendo de los requisitos específicos.",
        "Este es solo un estimado y puede cambiar.",
        "Contacta con nosotros para un presupuesto más detallado.",
        "Los precios están sujetos a cambios sin previo aviso."
    ];

    showPriceButton.addEventListener('click', function() {
        if(priceCard.style.display == 'block') {
            priceCard.style.display = 'none';
            return;
        }

        const randomPriceIndex = Math.floor(Math.random() * randomPrices.length);
        const randomTextIndex = Math.floor(Math.random() * randomTexts.length);

        priceCardField.textContent = randomPrices[randomPriceIndex];
        priceCardText.textContent = randomTexts[randomTextIndex];

        priceCard.style.display = 'block';
    });

    closePriceCard.addEventListener('click', function() {
        priceCard.style.display = 'none';
    });
});