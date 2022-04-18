<section class="content">
      <div class="container-fluid">
        <div class="row">
          <section class="col-lg-12"><!-- connectedSortable-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Materias</h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#registro" data-toggle="tab">Registro</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#consultar" data-toggle="tab">Consultar</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#documentos" data-toggle="tab">Documentos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#asistencias" data-toggle="tab">Asistencias</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#seguimiento" data-toggle="tab">Seguimiento</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content p-0">
                  <div class="chart tab-pane active" id="registro" style="position: relative; border: solid 0px purple;">
                      <canvas id="registro-canvas" style="border: solid 0px red; height: 90%; width: 100%"></canvas>
                   </div>
                  <div class="chart tab-pane" id="consultar" style="position: relative;">
                    <canvas id="consultar-canvas" height="auto" style="border: solid 0px blue; height: 90%; width: 100%"></canvas>
                  </div>
                  <div class="chart tab-pane" id="documentos" style="position: relative;">
                    <canvas id="documentos-canvas" height="auto" style="border: solid 0px green; height: 90%; width: 100%"></canvas>
                  </div>
                  <div class="chart tab-pane" id="asistencias" style="position: relative;">
                    <canvas id="asistencias-canvas" height="auto" style="border: solid 0px yellow; height: 90%; width: 100%"></canvas>
                  </div>
                  <div class="chart tab-pane" id="seguimiento" style="position: relative;">
                    <canvas id="seguimiento-canvas" height="auto" style="border: solid 0px orange; height: 90%; width: 100%"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>