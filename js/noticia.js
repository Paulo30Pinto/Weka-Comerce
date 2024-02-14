
//  alert("Ola mundo");

  document.getElementById('poeta1').addEventListener('click', function(even){
    even.preventDefault()
      let pic = $('#poeta1 img').attr('src')
      let pic2 = $('#poeta0').attr('src')
      let texto = $('#nome').text()
      let texto1 = $('#nome').text('Augusto Bunga')
    //  texto1
     // alert(texto1)
    $('#poeta0').attr({
      src: pic,
    })
    $('#poeta1 img').attr({
      src: pic2
    })
     if(pic == 'img/bebo6.JPG'){
      texto1
     }
     else{
      texto
     }
  })
  document.getElementById('poeta2').addEventListener('click', function(even){
    even.preventDefault()
      let pic = $('#poeta2 img').attr('src')
      let pic2 = $('#poeta0').attr('src')
      let texto = $('#nome').text()
      let texto1 = $('#nome').text('Rabby')
     // alert(pic2)
    $('#poeta0').attr({
      src: pic
    })
    $('#poeta2 img').attr({
      src: pic2
    })
    if(pic == 'img/Rabby1.JPG'){
      texto1
     }
     else{
      texto
     }
  })
  document.getElementById('poeta3').addEventListener('click', function(){
  //  even.preventDefault()
  alert(pic2)
      let pic = $('#poeta3 img').attr('src')
      let pic2 = $('#poeta0').attr('src')
      let texto = $('#nome').text()
      let texto1 = $('#nome').text('Simão Caetano')
     // alert(pic2)
    $('#poeta0').attr({
      src: pic
    })
    $('#poeta3 img').attr({
      src: pic2
    })
    if(pic == 'img/simao.JPG'){
      texto1
     }
     else{
      texto
     }
  })
