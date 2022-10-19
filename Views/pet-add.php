<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Registro de My New Pet</h2>
               <form action="<?php echo FRONT_ROOT.'Owner/AddPet'?>" method="post" class="bg-light-alpha p-5">
               
               
               <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Name</label>
                                   <input type="text" name="name" class="form-control" required>
                              </div>
                        </div>
              
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Photo</label>
                                   <input  type="file" name="photo" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Type</label>
                                   <br>
                                   <input type="radio", name="type" value="small"  required>Small
                                   <input type="radio", name="type" value="medium"  required>Medium
                                   <input type="radio", name="type" value="big" required>Big
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Raze</label>
                                   <input type="text" name="raze" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Size</label>
                                   <input type="number" name="size" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Vaccination Photo</label>
                                   <input  type="file" name="vaccination" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Observations</label>
                                   <input type="text" name="observations" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Video</label>
                                   <input  type="file" name="video" class="form-control" required>
                              </div>
                        </div>
                        <button type="submit" class="btn btn-dark ml-auto d-block">Register My Pet</button>
                    </div>
               </form>
          </div>
     </section>
</main>