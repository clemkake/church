<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\Calendarinstances;
use EcclesiaCRM\CalendarinstancesQuery;
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
 * This class defines the structure of the 'calendarinstances' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CalendarinstancesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.CalendarinstancesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'calendarinstances';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\Calendarinstances';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.Calendarinstances';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 18;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 18;

    /**
     * the column name for the id field
     */
    const COL_ID = 'calendarinstances.id';

    /**
     * the column name for the calendarid field
     */
    const COL_CALENDARID = 'calendarinstances.calendarid';

    /**
     * the column name for the principaluri field
     */
    const COL_PRINCIPALURI = 'calendarinstances.principaluri';

    /**
     * the column name for the access field
     */
    const COL_ACCESS = 'calendarinstances.access';

    /**
     * the column name for the displayname field
     */
    const COL_DISPLAYNAME = 'calendarinstances.displayname';

    /**
     * the column name for the uri field
     */
    const COL_URI = 'calendarinstances.uri';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'calendarinstances.description';

    /**
     * the column name for the calendarorder field
     */
    const COL_CALENDARORDER = 'calendarinstances.calendarorder';

    /**
     * the column name for the calendarcolor field
     */
    const COL_CALENDARCOLOR = 'calendarinstances.calendarcolor';

    /**
     * the column name for the visible field
     */
    const COL_VISIBLE = 'calendarinstances.visible';

    /**
     * the column name for the present field
     */
    const COL_PRESENT = 'calendarinstances.present';

    /**
     * the column name for the timezone field
     */
    const COL_TIMEZONE = 'calendarinstances.timezone';

    /**
     * the column name for the transparent field
     */
    const COL_TRANSPARENT = 'calendarinstances.transparent';

    /**
     * the column name for the share_href field
     */
    const COL_SHARE_HREF = 'calendarinstances.share_href';

    /**
     * the column name for the share_displayname field
     */
    const COL_SHARE_DISPLAYNAME = 'calendarinstances.share_displayname';

    /**
     * the column name for the share_invitestatus field
     */
    const COL_SHARE_INVITESTATUS = 'calendarinstances.share_invitestatus';

    /**
     * the column name for the grpid field
     */
    const COL_GRPID = 'calendarinstances.grpid';

    /**
     * the column name for the cal_type field
     */
    const COL_CAL_TYPE = 'calendarinstances.cal_type';

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
        self::TYPE_PHPNAME       => array('Id', 'Calendarid', 'Principaluri', 'Access', 'Displayname', 'Uri', 'Description', 'Calendarorder', 'Calendarcolor', 'Visible', 'Present', 'Timezone', 'Transparent', 'ShareHref', 'ShareDisplayname', 'ShareInvitestatus', 'GroupId', 'Type', ),
        self::TYPE_CAMELNAME     => array('id', 'calendarid', 'principaluri', 'access', 'displayname', 'uri', 'description', 'calendarorder', 'calendarcolor', 'visible', 'present', 'timezone', 'transparent', 'shareHref', 'shareDisplayname', 'shareInvitestatus', 'groupId', 'type', ),
        self::TYPE_COLNAME       => array(CalendarinstancesTableMap::COL_ID, CalendarinstancesTableMap::COL_CALENDARID, CalendarinstancesTableMap::COL_PRINCIPALURI, CalendarinstancesTableMap::COL_ACCESS, CalendarinstancesTableMap::COL_DISPLAYNAME, CalendarinstancesTableMap::COL_URI, CalendarinstancesTableMap::COL_DESCRIPTION, CalendarinstancesTableMap::COL_CALENDARORDER, CalendarinstancesTableMap::COL_CALENDARCOLOR, CalendarinstancesTableMap::COL_VISIBLE, CalendarinstancesTableMap::COL_PRESENT, CalendarinstancesTableMap::COL_TIMEZONE, CalendarinstancesTableMap::COL_TRANSPARENT, CalendarinstancesTableMap::COL_SHARE_HREF, CalendarinstancesTableMap::COL_SHARE_DISPLAYNAME, CalendarinstancesTableMap::COL_SHARE_INVITESTATUS, CalendarinstancesTableMap::COL_GRPID, CalendarinstancesTableMap::COL_CAL_TYPE, ),
        self::TYPE_FIELDNAME     => array('id', 'calendarid', 'principaluri', 'access', 'displayname', 'uri', 'description', 'calendarorder', 'calendarcolor', 'visible', 'present', 'timezone', 'transparent', 'share_href', 'share_displayname', 'share_invitestatus', 'grpid', 'cal_type', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Calendarid' => 1, 'Principaluri' => 2, 'Access' => 3, 'Displayname' => 4, 'Uri' => 5, 'Description' => 6, 'Calendarorder' => 7, 'Calendarcolor' => 8, 'Visible' => 9, 'Present' => 10, 'Timezone' => 11, 'Transparent' => 12, 'ShareHref' => 13, 'ShareDisplayname' => 14, 'ShareInvitestatus' => 15, 'GroupId' => 16, 'Type' => 17, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'calendarid' => 1, 'principaluri' => 2, 'access' => 3, 'displayname' => 4, 'uri' => 5, 'description' => 6, 'calendarorder' => 7, 'calendarcolor' => 8, 'visible' => 9, 'present' => 10, 'timezone' => 11, 'transparent' => 12, 'shareHref' => 13, 'shareDisplayname' => 14, 'shareInvitestatus' => 15, 'groupId' => 16, 'type' => 17, ),
        self::TYPE_COLNAME       => array(CalendarinstancesTableMap::COL_ID => 0, CalendarinstancesTableMap::COL_CALENDARID => 1, CalendarinstancesTableMap::COL_PRINCIPALURI => 2, CalendarinstancesTableMap::COL_ACCESS => 3, CalendarinstancesTableMap::COL_DISPLAYNAME => 4, CalendarinstancesTableMap::COL_URI => 5, CalendarinstancesTableMap::COL_DESCRIPTION => 6, CalendarinstancesTableMap::COL_CALENDARORDER => 7, CalendarinstancesTableMap::COL_CALENDARCOLOR => 8, CalendarinstancesTableMap::COL_VISIBLE => 9, CalendarinstancesTableMap::COL_PRESENT => 10, CalendarinstancesTableMap::COL_TIMEZONE => 11, CalendarinstancesTableMap::COL_TRANSPARENT => 12, CalendarinstancesTableMap::COL_SHARE_HREF => 13, CalendarinstancesTableMap::COL_SHARE_DISPLAYNAME => 14, CalendarinstancesTableMap::COL_SHARE_INVITESTATUS => 15, CalendarinstancesTableMap::COL_GRPID => 16, CalendarinstancesTableMap::COL_CAL_TYPE => 17, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'calendarid' => 1, 'principaluri' => 2, 'access' => 3, 'displayname' => 4, 'uri' => 5, 'description' => 6, 'calendarorder' => 7, 'calendarcolor' => 8, 'visible' => 9, 'present' => 10, 'timezone' => 11, 'transparent' => 12, 'share_href' => 13, 'share_displayname' => 14, 'share_invitestatus' => 15, 'grpid' => 16, 'cal_type' => 17, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
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
        $this->setName('calendarinstances');
        $this->setPhpName('Calendarinstances');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\Calendarinstances');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addColumn('calendarid', 'Calendarid', 'INTEGER', true, 10, null);
        $this->addColumn('principaluri', 'Principaluri', 'VARCHAR', false, 100, null);
        $this->addColumn('access', 'Access', 'BOOLEAN', true, 1, true);
        $this->addColumn('displayname', 'Displayname', 'VARCHAR', false, 100, null);
        $this->addColumn('uri', 'Uri', 'VARCHAR', false, 200, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('calendarorder', 'Calendarorder', 'INTEGER', true, null, 0);
        $this->addColumn('calendarcolor', 'Calendarcolor', 'VARCHAR', false, 10, null);
        $this->addColumn('visible', 'Visible', 'BOOLEAN', true, 1, false);
        $this->addColumn('present', 'Present', 'BOOLEAN', true, 1, false);
        $this->addColumn('timezone', 'Timezone', 'LONGVARCHAR', false, null, null);
        $this->addColumn('transparent', 'Transparent', 'BOOLEAN', true, 1, false);
        $this->addColumn('share_href', 'ShareHref', 'VARCHAR', false, 100, null);
        $this->addColumn('share_displayname', 'ShareDisplayname', 'VARCHAR', false, 100, null);
        $this->addColumn('share_invitestatus', 'ShareInvitestatus', 'BOOLEAN', true, 1, true);
        $this->addColumn('grpid', 'GroupId', 'SMALLINT', false, 9, 0);
        $this->addColumn('cal_type', 'Type', 'TINYINT', true, 2, 1);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CalendarinstancesTableMap::CLASS_DEFAULT : CalendarinstancesTableMap::OM_CLASS;
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
     * @return array           (Calendarinstances object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CalendarinstancesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CalendarinstancesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CalendarinstancesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CalendarinstancesTableMap::OM_CLASS;
            /** @var Calendarinstances $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CalendarinstancesTableMap::addInstanceToPool($obj, $key);
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
            $key = CalendarinstancesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CalendarinstancesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Calendarinstances $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CalendarinstancesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_ID);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_CALENDARID);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_PRINCIPALURI);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_ACCESS);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_DISPLAYNAME);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_URI);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_CALENDARORDER);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_CALENDARCOLOR);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_VISIBLE);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_PRESENT);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_TIMEZONE);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_TRANSPARENT);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_SHARE_HREF);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_SHARE_DISPLAYNAME);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_SHARE_INVITESTATUS);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_GRPID);
            $criteria->addSelectColumn(CalendarinstancesTableMap::COL_CAL_TYPE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.calendarid');
            $criteria->addSelectColumn($alias . '.principaluri');
            $criteria->addSelectColumn($alias . '.access');
            $criteria->addSelectColumn($alias . '.displayname');
            $criteria->addSelectColumn($alias . '.uri');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.calendarorder');
            $criteria->addSelectColumn($alias . '.calendarcolor');
            $criteria->addSelectColumn($alias . '.visible');
            $criteria->addSelectColumn($alias . '.present');
            $criteria->addSelectColumn($alias . '.timezone');
            $criteria->addSelectColumn($alias . '.transparent');
            $criteria->addSelectColumn($alias . '.share_href');
            $criteria->addSelectColumn($alias . '.share_displayname');
            $criteria->addSelectColumn($alias . '.share_invitestatus');
            $criteria->addSelectColumn($alias . '.grpid');
            $criteria->addSelectColumn($alias . '.cal_type');
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
        return Propel::getServiceContainer()->getDatabaseMap(CalendarinstancesTableMap::DATABASE_NAME)->getTable(CalendarinstancesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CalendarinstancesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CalendarinstancesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CalendarinstancesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Calendarinstances or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Calendarinstances object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarinstancesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\Calendarinstances) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CalendarinstancesTableMap::DATABASE_NAME);
            $criteria->add(CalendarinstancesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CalendarinstancesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CalendarinstancesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CalendarinstancesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the calendarinstances table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CalendarinstancesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Calendarinstances or Criteria object.
     *
     * @param mixed               $criteria Criteria or Calendarinstances object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarinstancesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Calendarinstances object
        }

        if ($criteria->containsKey(CalendarinstancesTableMap::COL_ID) && $criteria->keyContainsValue(CalendarinstancesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CalendarinstancesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CalendarinstancesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CalendarinstancesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CalendarinstancesTableMap::buildTableMap();
