<x-dashboard>
  <main class="main-container">
      <div class="main-title">
        <p class="font-weight-bold">DASHBOARD</p>
      </div>

      <div class="main-cards">

        <div class="card">
          <div class="card-inner">
            <p class="text-primary">USUARIOS REGISTRADOS</p>
            <span class="material-icons-outlined text-blue">group</span>
          </div>
          <span class="text-primary font-weight-bold">{{
$numeroUsuarios }}</span>
        </div>

        <div class="card">
          <div class="card-inner">
            <p class="text-primary">PUBLICACIONES</p>
            <span class="material-icons-outlined
text-orange">mark_as_unread</span>
          </div>
          <span class="text-primary font-weight-bold">{{
$numeroPublicaciones }}</span>
        </div>

        <div class="card">
          <div class="card-inner">
            <p class="text-primary">COMENTARIOS</p>
            <span class="material-icons-outlined text-green">forum</span>
          </div>
          <span class="text-primary font-weight-bold">{{
$numeroComentarios }}</span>
        </div>

        <div class="card">
          <div class="card-inner">
            <p class="text-primary">CARRERAS</p>
            <span class="material-icons-outlined text-red">school</span>
          </div>
          <span class="text-primary font-weight-bold">{{
$numeroCarreras }}</span>
        </div>

      </div>

      <div class="charts">

        <div class="charts-card">
          <p class="chart-title">Usuarios Registrados por Mes</p>
          <!-- Agrega un lienzo canvas para el gráfico -->
          <canvas id="usuarios-chart" width="400" height="300"></canvas>
        </div>

        <div class="charts-card">
          <p class="chart-title">Usuarios Registrados por Mes</p>
          <!-- Agrega un lienzo canvas para el gráfico -->
          <canvas id="usuarios-chart" width="400" height="300"></canvas>
        </div>

      </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      // Datos para el gráfico
      var datosUsuariosPorMes = {
          labels: {!! isset($usuariosPorMes) ?
json_encode($usuariosPorMes->pluck('month')->map(function($month) {
              return date('F', mktime(0, 0, 0, $month, 1));
          })) : '[]' !!},
          datasets: [{
              label: 'Cantidad de Usuarios Registrados',
              data: {!! isset($usuariosPorMes) ?
json_encode($usuariosPorMes->pluck('total')) : '[]' !!},
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1
          }]
      };

      // Obtén el contexto del lienzo canvas
      var ctx = document.getElementById('usuarios-chart').getContext('2d');
      // Configurar y renderizar el gráfico
      var usuariosChart = new Chart(ctx, {
          type: 'bar',
          data: datosUsuariosPorMes,
          options: {
              scales: {
                  y: {
                      beginAtZero: true,
                      title: {
                          display: true,
                          text: 'Cantidad de Usuarios Registrados'
                      }
                  },
                  x: {
                      title: {
                          display: true,
                          text: 'Mes'
                      }
                  }
              }
          }
      });





  </script>
</x-dashboard>