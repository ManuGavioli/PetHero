<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Editar datos de la Mascota</h2>
               <form action="<?php echo FRONT_ROOT."Pet/PetEditOk"?>" method="post" enctype="multipart/form-data">  
                                                <div class="col-lg-4">
                                                   <div class="form-group">
                                                       <label for="">Tipo</label>
                                                       <br>
                                                       <input type="radio", name="petType" value="small"  required <?php if ($petedit->getPetType()=='small'){echo 'checked'; }?>> Pequeño
                                                       <br>
                                                       <input type="radio", name="petType" value="medium"  required <?php if ($petedit->getPetType()=='medium'){echo 'checked'; }?>> Mediano
                                                       <br>
                                                       <input type="radio", name="petType" value="big" required <?php if ($petedit->getPetType()=='big'){echo 'checked'; }?>> Grande
                                                  </div>
                                                </div>
                                                <div class="col-lg-4">
                                                            <div class="form-group">
                                                                 <label for="">Peso en KG</label>
                                                                 <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" type="number" name="size" class="form-control" value="<?php echo $petedit->getSize() ?>" placeholder="<?php echo $petedit->getSize() ?>" required>
                                                            </div>
                                                  </div>
                                                  <div class="col-lg-4">
                                                            <div class="form-group">
                                                                 <label for="">Observaciones</label>
                                                                 <input maxlength="270" type="text" name="observations" class="form-control" value="<?php echo $petedit->getObservations() ?>" placeholder="<?php echo $petedit->getObservations() ?>" required>
                                                            </div>
                                                  </div>
                                                  <div class="col-lg-4">
                                                            <div class="form-group">
                                                                 <label for="">Video</label>
                                                                 <input  type="url" name="video" class="form-control" value="<?php echo 'https://www.youtube.com/watch?v='.$petedit->getVideo() ?>" placeholder="<?php echo 'https://www.youtube.com/watch?v='.$petedit->getVideo() ?>" required>
                                                            </div>
                                                  </div>
                                                            <div class="form-group">
                                                                 <label for="">Foto</label>
                                                                 <input  type="file" name="photoedit" class="form-control">
                                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="idpet" value="<?php echo $petedit->getId(); ?>" class="btn btn-primary btn-lg btn-block" style="background-color: #48c; color: #fff" >Editar</button>
                                        </div>
                        </form>
          </div>
     </section>
</main>








