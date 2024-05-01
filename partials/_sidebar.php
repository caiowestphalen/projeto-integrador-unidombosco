<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Painel de Controle</span>
            </a>
          </li>
          <li class="nav-item nav-category">Gestão de Clientes</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-account-plus"></i>
              <span class="menu-title">Alunos</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="novoaluno.php">Novo Aluno</a></li>
                <li class="nav-item"> <a class="nav-link" href="gerenciar.php">Gerenciar Alunos</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon mdi mdi-heart-pulse"></i>
              <span class="menu-title">Avaliações</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="#">Nova Avaliação</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Consultar Avaliações</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category">Gestão Administrativa</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Financeiro</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#"> Abrir Caixa </a></li>
                <li class="nav-item"> <a class="nav-link" href="#"> Fechamento de Caixa </a></li>
                <li class="nav-item"> <a class="nav-link" href="#"> Recibo de Pagamento </a></li>
              </ul>
            </div>
          </li>

        </ul>
      </nav>