<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\User;
use EcclesiaCRM\UserQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'user_usr' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.UserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'user_usr';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\User';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.User';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 47;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 47;

    /**
     * the column name for the usr_per_ID field
     */
    const COL_USR_PER_ID = 'user_usr.usr_per_ID';

    /**
     * the column name for the usr_HomeDir field
     */
    const COL_USR_HOMEDIR = 'user_usr.usr_HomeDir';

    /**
     * the column name for the usr_CurrentPath field
     */
    const COL_USR_CURRENTPATH = 'user_usr.usr_CurrentPath';

    /**
     * the column name for the usr_role_id field
     */
    const COL_USR_ROLE_ID = 'user_usr.usr_role_id';

    /**
     * the column name for the usr_Password field
     */
    const COL_USR_PASSWORD = 'user_usr.usr_Password';

    /**
     * the column name for the usr_NeedPasswordChange field
     */
    const COL_USR_NEEDPASSWORDCHANGE = 'user_usr.usr_NeedPasswordChange';

    /**
     * the column name for the usr_LastLogin field
     */
    const COL_USR_LASTLOGIN = 'user_usr.usr_LastLogin';

    /**
     * the column name for the usr_LoginCount field
     */
    const COL_USR_LOGINCOUNT = 'user_usr.usr_LoginCount';

    /**
     * the column name for the usr_FailedLogins field
     */
    const COL_USR_FAILEDLOGINS = 'user_usr.usr_FailedLogins';

    /**
     * the column name for the usr_AddRecords field
     */
    const COL_USR_ADDRECORDS = 'user_usr.usr_AddRecords';

    /**
     * the column name for the usr_EditRecords field
     */
    const COL_USR_EDITRECORDS = 'user_usr.usr_EditRecords';

    /**
     * the column name for the usr_DeleteRecords field
     */
    const COL_USR_DELETERECORDS = 'user_usr.usr_DeleteRecords';

    /**
     * the column name for the usr_MenuOptions field
     */
    const COL_USR_MENUOPTIONS = 'user_usr.usr_MenuOptions';

    /**
     * the column name for the usr_ManageGroups field
     */
    const COL_USR_MANAGEGROUPS = 'user_usr.usr_ManageGroups';

    /**
     * the column name for the usr_Finance field
     */
    const COL_USR_FINANCE = 'user_usr.usr_Finance';

    /**
     * the column name for the usr_Notes field
     */
    const COL_USR_NOTES = 'user_usr.usr_Notes';

    /**
     * the column name for the usr_Admin field
     */
    const COL_USR_ADMIN = 'user_usr.usr_Admin';

    /**
     * the column name for the usr_PastoralCare field
     */
    const COL_USR_PASTORALCARE = 'user_usr.usr_PastoralCare';

    /**
     * the column name for the usr_MailChimp field
     */
    const COL_USR_MAILCHIMP = 'user_usr.usr_MailChimp';

    /**
     * the column name for the usr_MainDashboard field
     */
    const COL_USR_MAINDASHBOARD = 'user_usr.usr_MainDashboard';

    /**
     * the column name for the usr_SeePrivacyData field
     */
    const COL_USR_SEEPRIVACYDATA = 'user_usr.usr_SeePrivacyData';

    /**
     * the column name for the usr_GDRP_DPO field
     */
    const COL_USR_GDRP_DPO = 'user_usr.usr_GDRP_DPO';

    /**
     * the column name for the usr_SearchLimit field
     */
    const COL_USR_SEARCHLIMIT = 'user_usr.usr_SearchLimit';

    /**
     * the column name for the usr_Style field
     */
    const COL_USR_STYLE = 'user_usr.usr_Style';

    /**
     * the column name for the usr_showPledges field
     */
    const COL_USR_SHOWPLEDGES = 'user_usr.usr_showPledges';

    /**
     * the column name for the usr_showPayments field
     */
    const COL_USR_SHOWPAYMENTS = 'user_usr.usr_showPayments';

    /**
     * the column name for the usr_showMenuQuery field
     */
    const COL_USR_SHOWMENUQUERY = 'user_usr.usr_showMenuQuery';

    /**
     * the column name for the usr_showSince field
     */
    const COL_USR_SHOWSINCE = 'user_usr.usr_showSince';

    /**
     * the column name for the usr_defaultFY field
     */
    const COL_USR_DEFAULTFY = 'user_usr.usr_defaultFY';

    /**
     * the column name for the usr_currentDeposit field
     */
    const COL_USR_CURRENTDEPOSIT = 'user_usr.usr_currentDeposit';

    /**
     * the column name for the usr_UserName field
     */
    const COL_USR_USERNAME = 'user_usr.usr_UserName';

    /**
     * the column name for the usr_webDavKey field
     */
    const COL_USR_WEBDAVKEY = 'user_usr.usr_webDavKey';

    /**
     * the column name for the usr_EditSelf field
     */
    const COL_USR_EDITSELF = 'user_usr.usr_EditSelf';

    /**
     * the column name for the usr_CalStart field
     */
    const COL_USR_CALSTART = 'user_usr.usr_CalStart';

    /**
     * the column name for the usr_CalEnd field
     */
    const COL_USR_CALEND = 'user_usr.usr_CalEnd';

    /**
     * the column name for the usr_CalNoSchool1 field
     */
    const COL_USR_CALNOSCHOOL1 = 'user_usr.usr_CalNoSchool1';

    /**
     * the column name for the usr_CalNoSchool2 field
     */
    const COL_USR_CALNOSCHOOL2 = 'user_usr.usr_CalNoSchool2';

    /**
     * the column name for the usr_CalNoSchool3 field
     */
    const COL_USR_CALNOSCHOOL3 = 'user_usr.usr_CalNoSchool3';

    /**
     * the column name for the usr_CalNoSchool4 field
     */
    const COL_USR_CALNOSCHOOL4 = 'user_usr.usr_CalNoSchool4';

    /**
     * the column name for the usr_CalNoSchool5 field
     */
    const COL_USR_CALNOSCHOOL5 = 'user_usr.usr_CalNoSchool5';

    /**
     * the column name for the usr_CalNoSchool6 field
     */
    const COL_USR_CALNOSCHOOL6 = 'user_usr.usr_CalNoSchool6';

    /**
     * the column name for the usr_CalNoSchool7 field
     */
    const COL_USR_CALNOSCHOOL7 = 'user_usr.usr_CalNoSchool7';

    /**
     * the column name for the usr_CalNoSchool8 field
     */
    const COL_USR_CALNOSCHOOL8 = 'user_usr.usr_CalNoSchool8';

    /**
     * the column name for the usr_SearchFamily field
     */
    const COL_USR_SEARCHFAMILY = 'user_usr.usr_SearchFamily';

    /**
     * the column name for the usr_Canvasser field
     */
    const COL_USR_CANVASSER = 'user_usr.usr_Canvasser';

    /**
     * the column name for the usr_ShowCart field
     */
    const COL_USR_SHOWCART = 'user_usr.usr_ShowCart';

    /**
     * the column name for the usr_ShowMap field
     */
    const COL_USR_SHOWMAP = 'user_usr.usr_ShowMap';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('PersonId', 'Homedir', 'Currentpath', 'RoleId', 'Password', 'NeedPasswordChange', 'LastLogin', 'LoginCount', 'FailedLogins', 'AddRecords', 'EditRecords', 'DeleteRecords', 'MenuOptions', 'ManageGroups', 'Finance', 'Notes', 'Admin', 'PastoralCare', 'MailChimp', 'MainDashboard', 'SeePrivacyData', 'GdrpDpo', 'SearchLimit', 'Style', 'ShowPledges', 'ShowPayments', 'ShowMenuQuery', 'ShowSince', 'DefaultFY', 'CurrentDeposit', 'UserName', 'Webdavkey', 'EditSelf', 'CalStart', 'CalEnd', 'CalNoSchool1', 'CalNoSchool2', 'CalNoSchool3', 'CalNoSchool4', 'CalNoSchool5', 'CalNoSchool6', 'CalNoSchool7', 'CalNoSchool8', 'Searchfamily', 'Canvasser', 'ShowCart', 'ShowMap', ),
        self::TYPE_CAMELNAME     => array('personId', 'homedir', 'currentpath', 'roleId', 'password', 'needPasswordChange', 'lastLogin', 'loginCount', 'failedLogins', 'addRecords', 'editRecords', 'deleteRecords', 'menuOptions', 'manageGroups', 'finance', 'notes', 'admin', 'pastoralCare', 'mailChimp', 'mainDashboard', 'seePrivacyData', 'gdrpDpo', 'searchLimit', 'style', 'showPledges', 'showPayments', 'showMenuQuery', 'showSince', 'defaultFY', 'currentDeposit', 'userName', 'webdavkey', 'editSelf', 'calStart', 'calEnd', 'calNoSchool1', 'calNoSchool2', 'calNoSchool3', 'calNoSchool4', 'calNoSchool5', 'calNoSchool6', 'calNoSchool7', 'calNoSchool8', 'searchfamily', 'canvasser', 'showCart', 'showMap', ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USR_PER_ID, UserTableMap::COL_USR_HOMEDIR, UserTableMap::COL_USR_CURRENTPATH, UserTableMap::COL_USR_ROLE_ID, UserTableMap::COL_USR_PASSWORD, UserTableMap::COL_USR_NEEDPASSWORDCHANGE, UserTableMap::COL_USR_LASTLOGIN, UserTableMap::COL_USR_LOGINCOUNT, UserTableMap::COL_USR_FAILEDLOGINS, UserTableMap::COL_USR_ADDRECORDS, UserTableMap::COL_USR_EDITRECORDS, UserTableMap::COL_USR_DELETERECORDS, UserTableMap::COL_USR_MENUOPTIONS, UserTableMap::COL_USR_MANAGEGROUPS, UserTableMap::COL_USR_FINANCE, UserTableMap::COL_USR_NOTES, UserTableMap::COL_USR_ADMIN, UserTableMap::COL_USR_PASTORALCARE, UserTableMap::COL_USR_MAILCHIMP, UserTableMap::COL_USR_MAINDASHBOARD, UserTableMap::COL_USR_SEEPRIVACYDATA, UserTableMap::COL_USR_GDRP_DPO, UserTableMap::COL_USR_SEARCHLIMIT, UserTableMap::COL_USR_STYLE, UserTableMap::COL_USR_SHOWPLEDGES, UserTableMap::COL_USR_SHOWPAYMENTS, UserTableMap::COL_USR_SHOWMENUQUERY, UserTableMap::COL_USR_SHOWSINCE, UserTableMap::COL_USR_DEFAULTFY, UserTableMap::COL_USR_CURRENTDEPOSIT, UserTableMap::COL_USR_USERNAME, UserTableMap::COL_USR_WEBDAVKEY, UserTableMap::COL_USR_EDITSELF, UserTableMap::COL_USR_CALSTART, UserTableMap::COL_USR_CALEND, UserTableMap::COL_USR_CALNOSCHOOL1, UserTableMap::COL_USR_CALNOSCHOOL2, UserTableMap::COL_USR_CALNOSCHOOL3, UserTableMap::COL_USR_CALNOSCHOOL4, UserTableMap::COL_USR_CALNOSCHOOL5, UserTableMap::COL_USR_CALNOSCHOOL6, UserTableMap::COL_USR_CALNOSCHOOL7, UserTableMap::COL_USR_CALNOSCHOOL8, UserTableMap::COL_USR_SEARCHFAMILY, UserTableMap::COL_USR_CANVASSER, UserTableMap::COL_USR_SHOWCART, UserTableMap::COL_USR_SHOWMAP, ),
        self::TYPE_FIELDNAME     => array('usr_per_ID', 'usr_HomeDir', 'usr_CurrentPath', 'usr_role_id', 'usr_Password', 'usr_NeedPasswordChange', 'usr_LastLogin', 'usr_LoginCount', 'usr_FailedLogins', 'usr_AddRecords', 'usr_EditRecords', 'usr_DeleteRecords', 'usr_MenuOptions', 'usr_ManageGroups', 'usr_Finance', 'usr_Notes', 'usr_Admin', 'usr_PastoralCare', 'usr_MailChimp', 'usr_MainDashboard', 'usr_SeePrivacyData', 'usr_GDRP_DPO', 'usr_SearchLimit', 'usr_Style', 'usr_showPledges', 'usr_showPayments', 'usr_showMenuQuery', 'usr_showSince', 'usr_defaultFY', 'usr_currentDeposit', 'usr_UserName', 'usr_webDavKey', 'usr_EditSelf', 'usr_CalStart', 'usr_CalEnd', 'usr_CalNoSchool1', 'usr_CalNoSchool2', 'usr_CalNoSchool3', 'usr_CalNoSchool4', 'usr_CalNoSchool5', 'usr_CalNoSchool6', 'usr_CalNoSchool7', 'usr_CalNoSchool8', 'usr_SearchFamily', 'usr_Canvasser', 'usr_ShowCart', 'usr_ShowMap', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PersonId' => 0, 'Homedir' => 1, 'Currentpath' => 2, 'RoleId' => 3, 'Password' => 4, 'NeedPasswordChange' => 5, 'LastLogin' => 6, 'LoginCount' => 7, 'FailedLogins' => 8, 'AddRecords' => 9, 'EditRecords' => 10, 'DeleteRecords' => 11, 'MenuOptions' => 12, 'ManageGroups' => 13, 'Finance' => 14, 'Notes' => 15, 'Admin' => 16, 'PastoralCare' => 17, 'MailChimp' => 18, 'MainDashboard' => 19, 'SeePrivacyData' => 20, 'GdrpDpo' => 21, 'SearchLimit' => 22, 'Style' => 23, 'ShowPledges' => 24, 'ShowPayments' => 25, 'ShowMenuQuery' => 26, 'ShowSince' => 27, 'DefaultFY' => 28, 'CurrentDeposit' => 29, 'UserName' => 30, 'Webdavkey' => 31, 'EditSelf' => 32, 'CalStart' => 33, 'CalEnd' => 34, 'CalNoSchool1' => 35, 'CalNoSchool2' => 36, 'CalNoSchool3' => 37, 'CalNoSchool4' => 38, 'CalNoSchool5' => 39, 'CalNoSchool6' => 40, 'CalNoSchool7' => 41, 'CalNoSchool8' => 42, 'Searchfamily' => 43, 'Canvasser' => 44, 'ShowCart' => 45, 'ShowMap' => 46, ),
        self::TYPE_CAMELNAME     => array('personId' => 0, 'homedir' => 1, 'currentpath' => 2, 'roleId' => 3, 'password' => 4, 'needPasswordChange' => 5, 'lastLogin' => 6, 'loginCount' => 7, 'failedLogins' => 8, 'addRecords' => 9, 'editRecords' => 10, 'deleteRecords' => 11, 'menuOptions' => 12, 'manageGroups' => 13, 'finance' => 14, 'notes' => 15, 'admin' => 16, 'pastoralCare' => 17, 'mailChimp' => 18, 'mainDashboard' => 19, 'seePrivacyData' => 20, 'gdrpDpo' => 21, 'searchLimit' => 22, 'style' => 23, 'showPledges' => 24, 'showPayments' => 25, 'showMenuQuery' => 26, 'showSince' => 27, 'defaultFY' => 28, 'currentDeposit' => 29, 'userName' => 30, 'webdavkey' => 31, 'editSelf' => 32, 'calStart' => 33, 'calEnd' => 34, 'calNoSchool1' => 35, 'calNoSchool2' => 36, 'calNoSchool3' => 37, 'calNoSchool4' => 38, 'calNoSchool5' => 39, 'calNoSchool6' => 40, 'calNoSchool7' => 41, 'calNoSchool8' => 42, 'searchfamily' => 43, 'canvasser' => 44, 'showCart' => 45, 'showMap' => 46, ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USR_PER_ID => 0, UserTableMap::COL_USR_HOMEDIR => 1, UserTableMap::COL_USR_CURRENTPATH => 2, UserTableMap::COL_USR_ROLE_ID => 3, UserTableMap::COL_USR_PASSWORD => 4, UserTableMap::COL_USR_NEEDPASSWORDCHANGE => 5, UserTableMap::COL_USR_LASTLOGIN => 6, UserTableMap::COL_USR_LOGINCOUNT => 7, UserTableMap::COL_USR_FAILEDLOGINS => 8, UserTableMap::COL_USR_ADDRECORDS => 9, UserTableMap::COL_USR_EDITRECORDS => 10, UserTableMap::COL_USR_DELETERECORDS => 11, UserTableMap::COL_USR_MENUOPTIONS => 12, UserTableMap::COL_USR_MANAGEGROUPS => 13, UserTableMap::COL_USR_FINANCE => 14, UserTableMap::COL_USR_NOTES => 15, UserTableMap::COL_USR_ADMIN => 16, UserTableMap::COL_USR_PASTORALCARE => 17, UserTableMap::COL_USR_MAILCHIMP => 18, UserTableMap::COL_USR_MAINDASHBOARD => 19, UserTableMap::COL_USR_SEEPRIVACYDATA => 20, UserTableMap::COL_USR_GDRP_DPO => 21, UserTableMap::COL_USR_SEARCHLIMIT => 22, UserTableMap::COL_USR_STYLE => 23, UserTableMap::COL_USR_SHOWPLEDGES => 24, UserTableMap::COL_USR_SHOWPAYMENTS => 25, UserTableMap::COL_USR_SHOWMENUQUERY => 26, UserTableMap::COL_USR_SHOWSINCE => 27, UserTableMap::COL_USR_DEFAULTFY => 28, UserTableMap::COL_USR_CURRENTDEPOSIT => 29, UserTableMap::COL_USR_USERNAME => 30, UserTableMap::COL_USR_WEBDAVKEY => 31, UserTableMap::COL_USR_EDITSELF => 32, UserTableMap::COL_USR_CALSTART => 33, UserTableMap::COL_USR_CALEND => 34, UserTableMap::COL_USR_CALNOSCHOOL1 => 35, UserTableMap::COL_USR_CALNOSCHOOL2 => 36, UserTableMap::COL_USR_CALNOSCHOOL3 => 37, UserTableMap::COL_USR_CALNOSCHOOL4 => 38, UserTableMap::COL_USR_CALNOSCHOOL5 => 39, UserTableMap::COL_USR_CALNOSCHOOL6 => 40, UserTableMap::COL_USR_CALNOSCHOOL7 => 41, UserTableMap::COL_USR_CALNOSCHOOL8 => 42, UserTableMap::COL_USR_SEARCHFAMILY => 43, UserTableMap::COL_USR_CANVASSER => 44, UserTableMap::COL_USR_SHOWCART => 45, UserTableMap::COL_USR_SHOWMAP => 46, ),
        self::TYPE_FIELDNAME     => array('usr_per_ID' => 0, 'usr_HomeDir' => 1, 'usr_CurrentPath' => 2, 'usr_role_id' => 3, 'usr_Password' => 4, 'usr_NeedPasswordChange' => 5, 'usr_LastLogin' => 6, 'usr_LoginCount' => 7, 'usr_FailedLogins' => 8, 'usr_AddRecords' => 9, 'usr_EditRecords' => 10, 'usr_DeleteRecords' => 11, 'usr_MenuOptions' => 12, 'usr_ManageGroups' => 13, 'usr_Finance' => 14, 'usr_Notes' => 15, 'usr_Admin' => 16, 'usr_PastoralCare' => 17, 'usr_MailChimp' => 18, 'usr_MainDashboard' => 19, 'usr_SeePrivacyData' => 20, 'usr_GDRP_DPO' => 21, 'usr_SearchLimit' => 22, 'usr_Style' => 23, 'usr_showPledges' => 24, 'usr_showPayments' => 25, 'usr_showMenuQuery' => 26, 'usr_showSince' => 27, 'usr_defaultFY' => 28, 'usr_currentDeposit' => 29, 'usr_UserName' => 30, 'usr_webDavKey' => 31, 'usr_EditSelf' => 32, 'usr_CalStart' => 33, 'usr_CalEnd' => 34, 'usr_CalNoSchool1' => 35, 'usr_CalNoSchool2' => 36, 'usr_CalNoSchool3' => 37, 'usr_CalNoSchool4' => 38, 'usr_CalNoSchool5' => 39, 'usr_CalNoSchool6' => 40, 'usr_CalNoSchool7' => 41, 'usr_CalNoSchool8' => 42, 'usr_SearchFamily' => 43, 'usr_Canvasser' => 44, 'usr_ShowCart' => 45, 'usr_ShowMap' => 46, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('user_usr');
        $this->setPhpName('User');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\User');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('usr_per_ID', 'PersonId', 'SMALLINT' , 'person_per', 'per_ID', true, 9, 0);
        $this->addColumn('usr_HomeDir', 'Homedir', 'VARCHAR', false, 500, null);
        $this->addColumn('usr_CurrentPath', 'Currentpath', 'VARCHAR', true, 1500, '/');
        $this->addForeignKey('usr_role_id', 'RoleId', 'SMALLINT', 'userrole_usrrol', 'usrrol_id', false, 11, null);
        $this->addColumn('usr_Password', 'Password', 'VARCHAR', true, 500, '');
        $this->addColumn('usr_NeedPasswordChange', 'NeedPasswordChange', 'BOOLEAN', true, 1, true);
        $this->addColumn('usr_LastLogin', 'LastLogin', 'TIMESTAMP', true, null, '2016-01-01 00:00:00');
        $this->addColumn('usr_LoginCount', 'LoginCount', 'SMALLINT', true, 5, 0);
        $this->addColumn('usr_FailedLogins', 'FailedLogins', 'TINYINT', true, 3, 0);
        $this->addColumn('usr_AddRecords', 'AddRecords', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_EditRecords', 'EditRecords', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_DeleteRecords', 'DeleteRecords', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_MenuOptions', 'MenuOptions', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_ManageGroups', 'ManageGroups', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_Finance', 'Finance', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_Notes', 'Notes', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_Admin', 'Admin', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_PastoralCare', 'PastoralCare', 'BOOLEAN', false, 1, false);
        $this->addColumn('usr_MailChimp', 'MailChimp', 'BOOLEAN', false, 1, false);
        $this->addColumn('usr_MainDashboard', 'MainDashboard', 'BOOLEAN', false, 1, false);
        $this->addColumn('usr_SeePrivacyData', 'SeePrivacyData', 'BOOLEAN', false, 1, false);
        $this->addColumn('usr_GDRP_DPO', 'GdrpDpo', 'BOOLEAN', false, 1, false);
        $this->addColumn('usr_SearchLimit', 'SearchLimit', 'TINYINT', false, null, 10);
        $this->addColumn('usr_Style', 'Style', 'VARCHAR', false, 50, 'Style.css');
        $this->addColumn('usr_showPledges', 'ShowPledges', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_showPayments', 'ShowPayments', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_showMenuQuery', 'ShowMenuQuery', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_showSince', 'ShowSince', 'DATE', true, null, '2016-01-01');
        $this->addColumn('usr_defaultFY', 'DefaultFY', 'SMALLINT', true, 9, 10);
        $this->addColumn('usr_currentDeposit', 'CurrentDeposit', 'SMALLINT', true, 9, 0);
        $this->addColumn('usr_UserName', 'UserName', 'VARCHAR', false, 32, null);
        $this->addColumn('usr_webDavKey', 'Webdavkey', 'VARCHAR', false, 255, null);
        $this->addColumn('usr_EditSelf', 'EditSelf', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_CalStart', 'CalStart', 'DATE', false, null, null);
        $this->addColumn('usr_CalEnd', 'CalEnd', 'DATE', false, null, null);
        $this->addColumn('usr_CalNoSchool1', 'CalNoSchool1', 'DATE', false, null, null);
        $this->addColumn('usr_CalNoSchool2', 'CalNoSchool2', 'DATE', false, null, null);
        $this->addColumn('usr_CalNoSchool3', 'CalNoSchool3', 'DATE', false, null, null);
        $this->addColumn('usr_CalNoSchool4', 'CalNoSchool4', 'DATE', false, null, null);
        $this->addColumn('usr_CalNoSchool5', 'CalNoSchool5', 'DATE', false, null, null);
        $this->addColumn('usr_CalNoSchool6', 'CalNoSchool6', 'DATE', false, null, null);
        $this->addColumn('usr_CalNoSchool7', 'CalNoSchool7', 'DATE', false, null, null);
        $this->addColumn('usr_CalNoSchool8', 'CalNoSchool8', 'DATE', false, null, null);
        $this->addColumn('usr_SearchFamily', 'Searchfamily', 'TINYINT', false, 3, null);
        $this->addColumn('usr_Canvasser', 'Canvasser', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_ShowCart', 'ShowCart', 'BOOLEAN', true, 1, false);
        $this->addColumn('usr_ShowMap', 'ShowMap', 'BOOLEAN', true, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Person', '\\EcclesiaCRM\\Person', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':usr_per_ID',
    1 => ':per_ID',
  ),
), null, null, null, false);
        $this->addRelation('UserRole', '\\EcclesiaCRM\\UserRole', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':usr_role_id',
    1 => ':usrrol_id',
  ),
), 'SET NULL', null, null, false);
        $this->addRelation('UserConfig', '\\EcclesiaCRM\\UserConfig', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ucfg_per_id',
    1 => ':usr_per_ID',
  ),
), null, null, 'UserConfigs', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UserTableMap::CLASS_DEFAULT : UserTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (User object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserTableMap::OM_CLASS;
            /** @var User $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var User $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserTableMap::COL_USR_PER_ID);
            $criteria->addSelectColumn(UserTableMap::COL_USR_HOMEDIR);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CURRENTPATH);
            $criteria->addSelectColumn(UserTableMap::COL_USR_ROLE_ID);
            $criteria->addSelectColumn(UserTableMap::COL_USR_PASSWORD);
            $criteria->addSelectColumn(UserTableMap::COL_USR_NEEDPASSWORDCHANGE);
            $criteria->addSelectColumn(UserTableMap::COL_USR_LASTLOGIN);
            $criteria->addSelectColumn(UserTableMap::COL_USR_LOGINCOUNT);
            $criteria->addSelectColumn(UserTableMap::COL_USR_FAILEDLOGINS);
            $criteria->addSelectColumn(UserTableMap::COL_USR_ADDRECORDS);
            $criteria->addSelectColumn(UserTableMap::COL_USR_EDITRECORDS);
            $criteria->addSelectColumn(UserTableMap::COL_USR_DELETERECORDS);
            $criteria->addSelectColumn(UserTableMap::COL_USR_MENUOPTIONS);
            $criteria->addSelectColumn(UserTableMap::COL_USR_MANAGEGROUPS);
            $criteria->addSelectColumn(UserTableMap::COL_USR_FINANCE);
            $criteria->addSelectColumn(UserTableMap::COL_USR_NOTES);
            $criteria->addSelectColumn(UserTableMap::COL_USR_ADMIN);
            $criteria->addSelectColumn(UserTableMap::COL_USR_PASTORALCARE);
            $criteria->addSelectColumn(UserTableMap::COL_USR_MAILCHIMP);
            $criteria->addSelectColumn(UserTableMap::COL_USR_MAINDASHBOARD);
            $criteria->addSelectColumn(UserTableMap::COL_USR_SEEPRIVACYDATA);
            $criteria->addSelectColumn(UserTableMap::COL_USR_GDRP_DPO);
            $criteria->addSelectColumn(UserTableMap::COL_USR_SEARCHLIMIT);
            $criteria->addSelectColumn(UserTableMap::COL_USR_STYLE);
            $criteria->addSelectColumn(UserTableMap::COL_USR_SHOWPLEDGES);
            $criteria->addSelectColumn(UserTableMap::COL_USR_SHOWPAYMENTS);
            $criteria->addSelectColumn(UserTableMap::COL_USR_SHOWMENUQUERY);
            $criteria->addSelectColumn(UserTableMap::COL_USR_SHOWSINCE);
            $criteria->addSelectColumn(UserTableMap::COL_USR_DEFAULTFY);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CURRENTDEPOSIT);
            $criteria->addSelectColumn(UserTableMap::COL_USR_USERNAME);
            $criteria->addSelectColumn(UserTableMap::COL_USR_WEBDAVKEY);
            $criteria->addSelectColumn(UserTableMap::COL_USR_EDITSELF);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALSTART);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALEND);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALNOSCHOOL1);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALNOSCHOOL2);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALNOSCHOOL3);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALNOSCHOOL4);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALNOSCHOOL5);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALNOSCHOOL6);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALNOSCHOOL7);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CALNOSCHOOL8);
            $criteria->addSelectColumn(UserTableMap::COL_USR_SEARCHFAMILY);
            $criteria->addSelectColumn(UserTableMap::COL_USR_CANVASSER);
            $criteria->addSelectColumn(UserTableMap::COL_USR_SHOWCART);
            $criteria->addSelectColumn(UserTableMap::COL_USR_SHOWMAP);
        } else {
            $criteria->addSelectColumn($alias . '.usr_per_ID');
            $criteria->addSelectColumn($alias . '.usr_HomeDir');
            $criteria->addSelectColumn($alias . '.usr_CurrentPath');
            $criteria->addSelectColumn($alias . '.usr_role_id');
            $criteria->addSelectColumn($alias . '.usr_Password');
            $criteria->addSelectColumn($alias . '.usr_NeedPasswordChange');
            $criteria->addSelectColumn($alias . '.usr_LastLogin');
            $criteria->addSelectColumn($alias . '.usr_LoginCount');
            $criteria->addSelectColumn($alias . '.usr_FailedLogins');
            $criteria->addSelectColumn($alias . '.usr_AddRecords');
            $criteria->addSelectColumn($alias . '.usr_EditRecords');
            $criteria->addSelectColumn($alias . '.usr_DeleteRecords');
            $criteria->addSelectColumn($alias . '.usr_MenuOptions');
            $criteria->addSelectColumn($alias . '.usr_ManageGroups');
            $criteria->addSelectColumn($alias . '.usr_Finance');
            $criteria->addSelectColumn($alias . '.usr_Notes');
            $criteria->addSelectColumn($alias . '.usr_Admin');
            $criteria->addSelectColumn($alias . '.usr_PastoralCare');
            $criteria->addSelectColumn($alias . '.usr_MailChimp');
            $criteria->addSelectColumn($alias . '.usr_MainDashboard');
            $criteria->addSelectColumn($alias . '.usr_SeePrivacyData');
            $criteria->addSelectColumn($alias . '.usr_GDRP_DPO');
            $criteria->addSelectColumn($alias . '.usr_SearchLimit');
            $criteria->addSelectColumn($alias . '.usr_Style');
            $criteria->addSelectColumn($alias . '.usr_showPledges');
            $criteria->addSelectColumn($alias . '.usr_showPayments');
            $criteria->addSelectColumn($alias . '.usr_showMenuQuery');
            $criteria->addSelectColumn($alias . '.usr_showSince');
            $criteria->addSelectColumn($alias . '.usr_defaultFY');
            $criteria->addSelectColumn($alias . '.usr_currentDeposit');
            $criteria->addSelectColumn($alias . '.usr_UserName');
            $criteria->addSelectColumn($alias . '.usr_webDavKey');
            $criteria->addSelectColumn($alias . '.usr_EditSelf');
            $criteria->addSelectColumn($alias . '.usr_CalStart');
            $criteria->addSelectColumn($alias . '.usr_CalEnd');
            $criteria->addSelectColumn($alias . '.usr_CalNoSchool1');
            $criteria->addSelectColumn($alias . '.usr_CalNoSchool2');
            $criteria->addSelectColumn($alias . '.usr_CalNoSchool3');
            $criteria->addSelectColumn($alias . '.usr_CalNoSchool4');
            $criteria->addSelectColumn($alias . '.usr_CalNoSchool5');
            $criteria->addSelectColumn($alias . '.usr_CalNoSchool6');
            $criteria->addSelectColumn($alias . '.usr_CalNoSchool7');
            $criteria->addSelectColumn($alias . '.usr_CalNoSchool8');
            $criteria->addSelectColumn($alias . '.usr_SearchFamily');
            $criteria->addSelectColumn($alias . '.usr_Canvasser');
            $criteria->addSelectColumn($alias . '.usr_ShowCart');
            $criteria->addSelectColumn($alias . '.usr_ShowMap');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME)->getTable(UserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or User object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\User) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserTableMap::DATABASE_NAME);
            $criteria->add(UserTableMap::COL_USR_PER_ID, (array) $values, Criteria::IN);
        }

        $query = UserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user_usr table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a User or Criteria object.
     *
     * @param mixed               $criteria Criteria or User object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from User object
        }


        // Set the correct dbName
        $query = UserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UserTableMap::buildTableMap();
