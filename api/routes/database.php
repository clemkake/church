<?php

use EcclesiaCRM\dto\Photo;
use EcclesiaCRM\dto\SystemURLs;
use EcclesiaCRM\FamilyCustomQuery;
use EcclesiaCRM\FamilyQuery;
use EcclesiaCRM\FileSystemUtils;
use EcclesiaCRM\NoteQuery;
use EcclesiaCRM\Person2group2roleP2g2rQuery;
use EcclesiaCRM\PersonCustomQuery;
use EcclesiaCRM\PersonQuery;
use EcclesiaCRM\PersonVolunteerOpportunityQuery;
use EcclesiaCRM\Service\SystemService;
use EcclesiaCRM\Slim\Middleware\Request\Auth\AdminRoleAuthMiddleware;
use EcclesiaCRM\UserQuery;
use EcclesiaCRM\Utils\LoggerUtils;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->group('/database', function () {
    $this->post('/backup', function ($request, $response, $args) {
        $input = (object) $request->getParsedBody();
        $backup = $this->SystemService->getDatabaseBackup($input);
        echo json_encode($backup);
    });

    $this->post('/backupRemote', function() use ($app, $systemService) {
        $backup = $this->SystemService->copyBackupToExternalStorage();
        echo json_encode($backup);
    });

    $this->post('/restore', function ($request, $response, $args) {
      
      if ( $_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST) &&
            empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0 )
        {  
          $systemService = new SystemService();
          throw new \Exception(gettext('The selected file exceeds this servers maximum upload size of').": ". $systemService->getMaxUploadFileSize()  , 500);
        }
        $fileName = $_FILES['restoreFile'];
        $restore = $this->SystemService->restoreDatabaseFromBackup($fileName);
        echo json_encode($restore);
    });

    $this->get('/download/{filename}', function ($request, $response, $args) {
        $filename = $args['filename'];
        $this->SystemService->download($filename);
    });
    
    $this->delete('/people/clear', 'clearPeopleTables');
});

function clearPeopleTables(Request $request, Response $response, array $p_args)
{
    $connection = Propel::getConnection();
    $logger = LoggerUtils::getAppLogger();
    
    $curUserId = $_SESSION["user"]->getId();
    
    $logger->info("People DB Clear started ");
    
    FamilyCustomQuery::create()->deleteAll($connection);
    $logger->info("Family custom deleted ");
    
    FamilyQuery::create()->deleteAll($connection);
    $logger->info("Families deleted");
    
    // Delete Family Photos
    FileSystemUtils::deleteFiles(SystemURLs::getImagesRoot() . "/Family/", Photo::getValidExtensions());
    FileSystemUtils::deleteFiles(SystemURLs::getImagesRoot() . "/Family/thumbnails/", Photo::getValidExtensions());
    $logger->info("family photos deleted");
    
    Person2group2roleP2g2rQuery::create()->deleteAll($connection);
    $logger->info("Person Group Roles deleted");
    
    PersonCustomQuery::create()->deleteAll($connection);
    $logger->info("Person Custom deleted");
    
    PersonVolunteerOpportunityQuery::create()->deleteAll($connection);
    $logger->info("Person Volunteer deleted");
    
    UserQuery::create()->filterByPersonId($curUserId, Criteria::NOT_EQUAL)->delete($connection);
    $logger->info("Users aide from person logged in deleted");
    
    PersonQuery::create()->filterById($curUserId, Criteria::NOT_EQUAL)->delete($connection);
    $logger->info("Persons aide from person logged in deleted");
    
    // Delete Person Photos
    FileSystemUtils::deleteFiles(SystemURLs::getImagesRoot() . "/Person/", Photo::getValidExtensions());
    FileSystemUtils::deleteFiles(SystemURLs::getImagesRoot() . "/Person/thumbnails/", Photo::getValidExtensions());
    $logger->info("people photos deleted");
    
    NoteQuery::create()->filterByPerId($curUserId, Criteria::NOT_EQUAL)->delete($connection);
    $logger->info("Notes deleted");
    
    // we empty the cart, to reset all
    $_SESSION['aPeopleCart'] = [];
    
    return $response->withJson(['success' => true, 'msg' => gettext('The people and families has been cleared from the database.')]);
}