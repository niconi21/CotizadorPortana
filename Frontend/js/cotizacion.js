$('#btnImprimirCotizacion').click(function(){
    generarPDF()

    // Save the PDF
    // doc.save('samp   le-document.pdf');
})

function generarPDF(){
    print()
    // try {
    //     var doc = new jsPDF();
    // var elementHTML = $('#cotizacionNota').html();
    // var specialElementHandlers = {
    //     '#elementH': (element, renderer) =>{
    //         return true;
    //     }
    // };
    // doc.fromHTML(elementHTML, 15, 15, {
    //     'width': 170,
    //     'elementHandlers': specialElementHandlers
    // },()=>{
    //     doc.save('documento.pdf');

    // });
    
    // console.log(elementHTML)
    // } catch (error) {
    //    console.log(error) 
    // }
}

//cotizacionNota