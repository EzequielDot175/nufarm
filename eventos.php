<?php require_once('Connections/conexion.php');error_reporting(0); ?>
<?php include("includes/header.php"); ?>

<div id="menu">
 <div class="link"><p><a href="index.php">Inicio</a></p></div>
             <div class="link-activo"><p><a href="canjes.php">Canjes</a></p></div>
              <div class="link"><p><a href="mi_cuenta.php">Mi Cuenta</a></p></div>
                <div class="link"><p><a href="novedades.php">Novedades</a></p></div>
 </ul>
</div>
<div id="buscador"></div>

<section>
<aside>
<?php include("includes/catalogo.php"); ?>
</aside>
<article>
<div class="productos">

       <div class="box-content2">
         <ul>
         <div class="sombra2"></div>
             <li>
  <div class="tipro2"><p>Eventos</p></div>
  <div class="box-imagen">
      <img src="eventos/evento-externo2.png" width="307" height="270"> </div>
     </li>
         </ul>
                     </div><!---- Fin box-content ---->
                            
                            <div id="info-evento"> 
                             <p>Los eventos brindan la posibilidad de crear un contacto directo con los clientes finales.</p>
<p>La presencia en encuentros zonales así como la realización de reuniones con productores, constituye un fuerte apoyo unitario e institucional desde Nufarm a su red de distribución. Dentro de esta categoría se puede optar por:</p>
                   <h4>EVENTOS INTERNOS</h4>
                   <h4>EVENTOS EXTERNOS</h4>        
              </div>
                            <div class="productos">
                         <div class="evento">
                         <h3>EVENTOS INTERNOS</h3>
                         <div class="box-content5">
                          <ul>
                          <div class="sombra3"></div>
                            <li>
                            <div class="box-imagen4">
                            <img src="eventos/evento-interno.png" width="307" height="270"></div>
                             <div class="info-evento">
                            <a class="capa-canje" href="evento_interno.php"><h4>CANJEAR</h4><p>Enviar Propuesta</p></a>
                                           </div>  
                         </li>
                              </ul>
                               
                              <h2>Charlas y Reuniones </h2>
                              <p>Organizadas por el distribuidor junto a Nufarm, dirigidas a clientes finales/ productores.<br /> En las mismas se podrán comunicar las novedades del negocio, beneficios de los Productos Nufarm, así como resolver dudas y consultas.</p><br />
                                   <h2>¿Cómo llevarlos a cabo?</h2>
                                   <p>Enviar desde <a style ="color:#9E1F63" href="evento_interno.php"><strong>CANJEAR</strong></a> una propuesta concreta con fecha probable, temática, lugar y cantidad de asistentes estimados.<br />
Presupuestar gastos involucrados (tales como comida, salón).
Emitir una factura* a Nufarm adjuntando comprobante de pago de gastos (facturas de pagos a proveedores, fotos del evento,etc.)</p>
                                             </div><!---- Fin box-content ---->
                                            </div> 
                                            
                                            
                        <div class="evento">
                        <h3>EVENTOS EXTERNOS</h3>
                         <div class="box-content5">
                          <ul>
                          <div class="sombra3"></div>
                            <li>
                            <div class="box-imagen4">
                            <img src="eventos/evento-externo.png" width="307" height="270"> </div> 
                           <div class="info-evento">
                            <a class="capa-canje" href="evento_externo.php"><h4>CANJEAR</h4><p>Enviar Propuesta</p></a>
                                           </div> 
                                           
                         </li>
                              </ul>
                              
                              <h2>Eventos zonales, Exposiciones y Jornadas</h2>
                              <p>Organizadas por instituciones y/o asociaciones, 
El distribuidor y Nufarm podrán estar presente mediante sponsoreos, patrocinios o presencia de marca.</p><br />
                             <h2>¿Cómo llevarlos a cabo?</h2>
                             p>Enviar desde <strong><a style ="color:#9E1F63" href="evento_externo.php">CANJEAR</a></strong> una propuesta con presupuestos de participación y presencia sugerida.
Marketing de Nufarm se comunicará para recibir confirmación y coordinar los detalles (Material de promoción e identificación como banderas, folletos y logo).
Emitir una factura* a Nufarm adjuntando comprobante de pago de gastos (facturas de pago al organizador, fotos del evento,etc)</p>


                                             </div><!---- Fin box-content ---->
                                            </div> 
                                            
                                      <div class="line"></div>
                           
                             </div> <!---------- Fin Productos --------------> 
                             <p class="texto-bajo">*La factura debe ser a nombre del distribuidor, enviarse a Nufarm con el fin de que pueda ser compensada en la cuenta del cliente.</p>     

</article>
</section>
</div>
</div></div></div></div>
<?php include("includes/footer.php"); ?>

