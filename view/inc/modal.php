 <!-- Modal Bootstrap -->
 <div class="modal fade" tabindex="-1" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Cambiar Contraseña</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <!-- Formulario de cambio de contraseña -->
                 <form>
                     <div class="mb-3">
                         <label for="currentPassword" class="form-label">Contraseña Actual</label>
                         <input type="password" class="form-control" id="txtClaveActual" required>
                     </div>
                     <div class="mb-3">
                         <label for="newPassword" class="form-label">Contraseña Nueva</label>
                         <input type="password" class="form-control" id="txtClaveNueva" required>
                     </div>
                     <div class="mb-3">
                         <label for="repeatPassword" class="form-label">Repetir Contraseña</label>
                         <input type="password" class="form-control" id="txtRepetirClaveNueva" required>
                     </div>
                 </form>
             </div>
             <div class="alert alert-danger" role="alert" id='divAlert' style="display: none;">
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                 <button type="button" class="btn btn-primary" id='btnCambiarClave'">Cambiar</button>
            </div>
            
        </div>
    </div> 
</div>