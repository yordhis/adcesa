  <!-- ======= Footer ======= -->
  <footer class="footer col-12">
      <div class="copyright">
          &copy; Copyright <strong><span>Adcesa 2023</span></strong>. Todos los derechos reservados
      </div>
      <div class="credits">
          Diseñado por <a href="#" target="_blank">Ing. Eleanna Azuaje</a>
      </div>
  </footer><!-- End Footer -->

  <!-- Loading Global -->
  <div id="global-loading"
      style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:9999;background:rgba(255,255,255,0.85);display:flex;align-items:center;justify-content:center;">
      <div style="text-align:center;">
          <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
              <span class="visually-hidden">Cargando...</span>
          </div>
          <div style="margin-top: 1rem; font-size: 1.2rem; color: #333;">Cargando...</div>
      </div>
  </div>

  <!-- Opcional: Ocultar el loading cuando la página esté lista -->
  <script>
      window.addEventListener('DOMContentLoaded', function() {
          setTimeout(() => {
              document.getElementById('global-loading').style.display = 'none';

          }, 1000);

          // Captura el submit de todos los formularios
          const formularios = document.forms;
          for (const form of formularios) {
              form.addEventListener('submit', function() {
                  document.getElementById('global-loading').style.display = 'flex';
              });
          }
      });
  </script>
