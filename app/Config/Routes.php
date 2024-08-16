<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/formulario', 'FormularioController::index');
$routes->get('/formulario/informacoes_pessoais', 'FormularioController::index/$1');
$routes->get('/formulario/informacoes_pessoais/(:num)', 'FormularioController::index/$1');
$routes->post('/formulario/salvarInformacoesPessoais', 'FormularioController::salvarInformacoesPessoais');
$routes->get('/formulario/historico_medico/(:num)', 'FormularioController::historicoMedico/$1');
$routes->post('/formulario/salvarHistoricoMedico/(:num)', 'FormularioController::salvarHistoricoMedico/$1');
$routes->get('/formulario/salvarEVoltar/(:num)', 'FormularioController::salvarEVoltar/$1');
$routes->get('/formulario/sintomas_atuais/(:num)', 'FormularioController::sintomasAtuais/$1');
$routes->post('/formulario/salvarSintomasAtuais/(:num)', 'FormularioController::salvarSintomasAtuais/$1');
$routes->get('/formulario/exames_diagnosticos/(:num)', 'FormularioController::examesDiagnosticos/$1');
$routes->post('/formulario/salvarExamesDiagnosticos/(:num)', 'FormularioController::salvarExamesDiagnosticos/$1');
$routes->get('/formulario/notas_plano_tratamento/(:num)', 'FormularioController::notasPlanoTratamento/$1');
$routes->post('/formulario/salvarNotasPlanoTratamento/(:num)', 'FormularioController::salvarNotasPlanoTratamento/$1');
$routes->get('/formulario/confirmacao/(:num)', 'FormularioController::confirmacao/$1');
$routes->get('/formulario/estilo_vida/(:num)', 'FormularioController::estiloVida/$1');
$routes->post('/formulario/salvarEstiloVida/(:num)', 'FormularioController::salvarEstiloVida/$1');
$routes->get('/formulario/finalizar/(:num)', 'FormularioController::finalizar/$1');
$routes->get('/formulario/sucesso', 'FormularioController::sucesso');
$routes->get('/formulario/listar_pacientes', 'FormularioController::listarPacientes');

$routes->get('gemini/generate/(:num)', 'GeminiController::generateText/$1');
$routes->get('gemini/view/(:num)', 'GeminiController::viewEvaluation/$1');

$routes->get('/call-maritaca/(:num)', 'ApiController::callMaritaca/$1');
$routes->get('maritaca/view/(:num)', 'ApiController::viewEvaluation/$1');


$routes->get('teste-env', function() {
    echo getenv('GEMINI_API_KEY');
});

$routes->get('paciente-unico', function() {
    echo 'Paciente_' . uniqid();
});
