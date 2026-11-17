    document.addEventListener("DOMContentLoaded", function() {
    
    // Hintayin matapos ang intro loading bar (2.5s)
    setTimeout(function() {
        
        // 1. Itago ang intro screen (mag-slide up)
        document.getElementById('introScreen').classList.add('hide');
        
        // 2. Ipakita ang Navigation
        document.getElementById('mainNav').classList.add('active');
        
        // 3. Ipakita ang Team Image
        document.getElementById('teamImage').classList.add('visible');

        // 4. Ipakita ang mga Text (Hero Title, Subtitle, Desc, Buttons)
        // Ang bawat isa ay may kanya-kanyang transition-delay sa CSS
        document.querySelector('.hero-title').classList.add('visible');
        document.querySelector('.hero-subtitle').classList.add('visible');
        document.querySelector('.hero-desc').classList.add('visible');
        document.querySelector('.hero-buttons').classList.add('visible');

    }, 2500); // 2500ms = 2.5 seconds
});  