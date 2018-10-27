<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/',
  function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
  });

$app->get('/courses',
  function ($request, $response, $args) {
    try {
      return $response->withJson(getCourses($this->dbh));
    } catch (\PDOException $e) {
      return $response->withJson($e);
    }
  });

$app->get('/course/{cID}',
  function ($request, $response, $args) {
    try {
      return $response->withJson(getCourse($this->dbh,
        (int)$args['cID']));
    } catch (\PDOException $e) {
      return $response->withJson($e);
    }
  });

$app->get('/calls/{cID}',
  function ($request, $response, $args) {
    try {
      return $response->withJson(getCalls($this->dbh,
        (int)$args['cID']));
    } catch (\PDOException $e) {
      return $response->withJson($e);
    }
  });

$app->post('/call',
  function ($request, $response, $args) {
    try {
      return $response->withJson(postCall($this->dbh,
        $request->getParsedBody()));
    } catch (\PDOException $e) {
      return $response->withJson($e);
    }
  });

$app->delete('/call/{cID}',
  function ($request, $response, $args) {
    try {
      return $response->withJson(deleteCall($this->dbh,
        (int)$args['cID']));
    } catch (\PDOException $e) {
      return $response->withJson($e);
    }
  });