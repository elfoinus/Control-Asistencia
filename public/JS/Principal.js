function mostrar(id) {
    if (id == 1) {
        $("#inicio").show();
        $("#control").hide();
        $("#admin").hide();
        $("#salir").hide();
        
        document.getElementById('eti1').style.background='#FE2E2E';
        document.getElementById('eti1').style.color='#FFFFFF';

        document.getElementById('eti2').style.background='#FFFFFF';
        document.getElementById('eti2').style.color='#FE2E2E';

        document.getElementById('eti3').style.background='#FFFFFF';
        document.getElementById('eti3').style.color='#FE2E2E';

        document.getElementById('eti4').style.background='#FFFFFF';
        document.getElementById('eti4').style.color='#FE2E2E';

        
    }

    if (id == 2) {
        
        $("#inicio").hide();
        $("#control").show();
        $("#admin").hide();
        $("#salir").hide();

        document.getElementById('eti1').style.background='#FFFFFF';
        document.getElementById('eti1').style.color='#FE2E2E';

        document.getElementById('eti2').style.background='#FE2E2E';
        document.getElementById('eti2').style.color='#FFFFFF';

        document.getElementById('eti3').style.background='#FFFFFF';
        document.getElementById('eti3').style.color='#FE2E2E';


        document.getElementById('eti4').style.background='#FFFFFF';
        document.getElementById('eti4').style.color='#FE2E2E';
    }

    if (id == 3) {
        $("#inicio").hide();
        $("#control").hide();
        $("#admin").show();
        $("#salir").hide();

        document.getElementById('eti1').style.background='#FFFFFF';
        document.getElementById('eti1').style.color='#FE2E2E';

        document.getElementById('eti2').style.background='#FFFFFF';
        document.getElementById('eti2').style.color='#FE2E2E';

        document.getElementById('eti3').style.background='#FE2E2E';
        document.getElementById('eti3').style.color='#FFFFFF';

        document.getElementById('eti4').style.background='#FFFFFF';
        document.getElementById('eti4').style.color='#FE2E2E';
    }

    if (id == 4) {
        $("#inicio").hide();
        $("#control").hide();
        $("#admin").hide();
        $("#salir").show();

        document.getElementById('eti1').style.background='#FFFFFF';
        document.getElementById('eti1').style.color='#FE2E2E';

        document.getElementById('eti2').style.background='#FFFFFF';
        document.getElementById('eti2').style.color='#FE2E2E';

        document.getElementById('eti3').style.background='#FFFFFF';
        document.getElementById('eti3').style.color='#FE2E2E';

        document.getElementById('eti4').style.background='#FE2E2E';
        document.getElementById('eti4').style.color='#FFFFFF';   
    }

}





