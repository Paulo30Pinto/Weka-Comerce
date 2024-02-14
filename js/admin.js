$(document).ready(function(){
  //alert("Ola Mundo")

  /**CLICK DO MUNU**/
  $("#btn-home").on({
    click: ()=>{
    //  alert("Ola Mundo")
      $("#sidebarMenu .nav-link").removeClass("active");
      $("#btn-home").addClass("active");
      $("main > div").addClass("d-none");
      $("#painel").removeClass("d-none")
    }
  })

  $("#btn-venda").on({
    click: ()=>{
    //  alert("Ola Mundo")
    $("#sidebarMenu .nav-link").removeClass("active");
    $("#btn-venda").addClass("active");
    $("main > div").addClass("d-none");
    $("#vanda").removeClass("d-none")
    }
  })
  $("#btn-prod").on({
    click: ()=>{
    //  alert("Ola Mundo")
    $("#sidebarMenu .nav-link").removeClass("active");
    $("#btn-prod").addClass("active");
    $("main > div").addClass("d-none");
    $("#entega").removeClass("d-none")
    }
  })
  $("#btn-clint").on({
    click: ()=>{
    //  alert("Ola Mundo")
    $("#sidebarMenu .nav-link").removeClass("active");
    $("#btn-clint").addClass("active");
    $("main > div").addClass("d-none");
    $("#clientes").removeClass("d-none")
    }
  })
  $("#btn-pedir").on({
    click: ()=>{
    //  alert("Ola Mundo")
    $("#sidebarMenu .nav-link").removeClass("active");
    $("#btn-pedir").addClass("active");
    $("main > div").addClass("d-none");
    $("#produtos").removeClass("d-none")
    }
  })
  $("#btn-fonecer").on({
    click: ()=>{
    //  alert("Ola Mundo")
    $("#sidebarMenu .nav-link").removeClass("active");
    $("#btn-fonecer").addClass("active");
    $("main > div").addClass("d-none");
    $("#fonecedor").removeClass("d-none")
    }
  })
  

});
