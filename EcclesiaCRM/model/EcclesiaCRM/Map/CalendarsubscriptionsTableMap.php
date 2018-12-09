<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\Calendarsubscriptions;
use EcclesiaCRM\CalendarsubscriptionsQuery;
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
 * This class defines the structure of the 'calendarsubscriptions' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CalendarsubscriptionsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.CalendarsubscriptionsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'calendarsubscriptions';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\Calendarsubscriptions';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.Calendarsubscriptions';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id field
     */
    const COL_ID = 'calendarsubscriptions.id';

    /**
     * the column name for the uri field
     */
    const COL_URI = 'calendarsubscriptions.uri';

    /**
     * the column name for the principaluri field
     */
    const COL_PRINCIPALURI = 'calendarsubscriptions.principaluri';

    /**
     * the column name for the source field
     */
    const COL_SOURCE = 'calendarsubscriptions.source';

    /**
     * the column name for the displayname field
     */
    const COL_DISPLAYNAME = 'calendarsubscriptions.displayname';

    /**
     * the column name for the refreshrate field
     */
    const COL_REFRESHRATE = 'calendarsubscriptions.refreshrate';

    /**
     * the column name for the calendarorder field
     */
    const COL_CALENDARORDER = 'calendarsubscriptions.calendarorder';

    /**
     * the column name for the calendarcolor field
     */
    const COL_CALENDARCOLOR = 'calendarsubscriptions.calendarcolor';

    /**
     * the column name for the striptodos field
     */
    const COL_STRIPTODOS = 'calendarsubscriptions.striptodos';

    /**
     * the column name for the stripalarms field
     */
    const COL_STRIPALARMS = 'calendarsubscriptions.stripalarms';

    /**
     * the column name for the stripattachments field
     */
    const COL_STRIPATTACHMENTS = 'calendarsubscriptions.stripattachments';

    /**
     * the column name for the lastmodified field
     */
    const COL_LASTMODIFIED = 'calendarsubscriptions.lastmodified';

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
        self::TYPE_PHPNAME       => array('Id', 'Uri', 'Principaluri', 'Source', 'Displayname', 'Refreshrate', 'Calendarorder', 'Calendarcolor', 'Striptodos', 'Stripalarms', 'Stripattachments', 'Lastmodified', ),
        self::TYPE_CAMELNAME     => array('id', 'uri', 'principaluri', 'source', 'displayname', 'refreshrate', 'calendarorder', 'calendarcolor', 'striptodos', 'stripalarms', 'stripattachments', 'lastmodified', ),
        self::TYPE_COLNAME       => array(CalendarsubscriptionsTableMap::COL_ID, CalendarsubscriptionsTableMap::COL_URI, CalendarsubscriptionsTableMap::COL_PRINCIPALURI, CalendarsubscriptionsTableMap::COL_SOURCE, CalendarsubscriptionsTableMap::COL_DISPLAYNAME, CalendarsubscriptionsTableMap::COL_REFRESHRATE, CalendarsubscriptionsTableMap::COL_CALENDARORDER, CalendarsubscriptionsTableMap::COL_CALENDARCOLOR, CalendarsubscriptionsTableMap::COL_STRIPTODOS, CalendarsubscriptionsTableMap::COL_STRIPALARMS, CalendarsubscriptionsTableMap::COL_STRIPATTACHMENTS, CalendarsubscriptionsTableMap::COL_LASTMODIFIED, ),
        self::TYPE_FIELDNAME     => array('id', 'uri', 'principaluri', 'source', 'displayname', 'refreshrate', 'calendarorder', 'calendarcolor', 'striptodos', 'stripalarms', 'stripattachments', 'lastmodified', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Uri' => 1, 'Principaluri' => 2, 'Source' => 3, 'Displayname' => 4, 'Refreshrate' => 5, 'Calendarorder' => 6, 'Calendarcolor' => 7, 'Striptodos' => 8, 'Stripalarms' => 9, 'Stripattachments' => 10, 'Lastmodified' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'uri' => 1, 'principaluri' => 2, 'source' => 3, 'displayname' => 4, 'refreshrate' => 5, 'calendarorder' => 6, 'calendarcolor' => 7, 'striptodos' => 8, 'stripalarms' => 9, 'stripattachments' => 10, 'lastmodified' => 11, ),
        self::TYPE_COLNAME       => array(CalendarsubscriptionsTableMap::COL_ID => 0, CalendarsubscriptionsTableMap::COL_URI => 1, CalendarsubscriptionsTableMap::COL_PRINCIPALURI => 2, CalendarsubscriptionsTableMap::COL_SOURCE => 3, CalendarsubscriptionsTableMap::COL_DISPLAYNAME => 4, CalendarsubscriptionsTableMap::COL_REFRESHRATE => 5, CalendarsubscriptionsTableMap::COL_CALENDARORDER => 6, CalendarsubscriptionsTableMap::COL_CALENDARCOLOR => 7, CalendarsubscriptionsTableMap::COL_STRIPTODOS => 8, CalendarsubscriptionsTableMap::COL_STRIPALARMS => 9, CalendarsubscriptionsTableMap::COL_STRIPATTACHMENTS => 10, CalendarsubscriptionsTableMap::COL_LASTMODIFIED => 11, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'uri' => 1, 'principaluri' => 2, 'source' => 3, 'displayname' => 4, 'refreshrate' => 5, 'calendarorder' => 6, 'calendarcolor' => 7, 'striptodos' => 8, 'stripalarms' => 9, 'stripattachments' => 10, 'lastmodified' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $this->setName('calendarsubscriptions');
        $this->setPhpName('Calendarsubscriptions');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\Calendarsubscriptions');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('uri', 'Uri', 'VARCHAR', true, 200, null);
        $this->addColumn('principaluri', 'Principaluri', 'VARCHAR', true, 100, null);
        $this->addColumn('source', 'Source', 'LONGVARCHAR', false, null, null);
        $this->addColumn('displayname', 'Displayname', 'VARCHAR', false, 100, null);
        $this->addColumn('refreshrate', 'Refreshrate', 'VARCHAR', false, 10, null);
        $this->addColumn('calendarorder', 'Calendarorder', 'INTEGER', true, null, 0);
        $this->addColumn('calendarcolor', 'Calendarcolor', 'VARCHAR', false, 10, null);
        $this->addColumn('striptodos', 'Striptodos', 'BOOLEAN', false, 1, null);
        $this->addColumn('stripalarms', 'Stripalarms', 'BOOLEAN', false, 1, null);
        $this->addColumn('stripattachments', 'Stripattachments', 'BOOLEAN', false, 1, null);
        $this->addColumn('lastmodified', 'Lastmodified', 'INTEGER', false, null, null);
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
        return $withPrefix ? CalendarsubscriptionsTableMap::CLASS_DEFAULT : CalendarsubscriptionsTableMap::OM_CLASS;
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
     * @return array           (Calendarsubscriptions object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CalendarsubscriptionsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CalendarsubscriptionsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CalendarsubscriptionsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CalendarsubscriptionsTableMap::OM_CLASS;
            /** @var Calendarsubscriptions $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CalendarsubscriptionsTableMap::addInstanceToPool($obj, $key);
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
            $key = CalendarsubscriptionsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CalendarsubscriptionsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Calendarsubscriptions $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CalendarsubscriptionsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_ID);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_URI);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_PRINCIPALURI);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_SOURCE);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_DISPLAYNAME);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_REFRESHRATE);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_CALENDARORDER);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_CALENDARCOLOR);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_STRIPTODOS);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_STRIPALARMS);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_STRIPATTACHMENTS);
            $criteria->addSelectColumn(CalendarsubscriptionsTableMap::COL_LASTMODIFIED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.uri');
            $criteria->addSelectColumn($alias . '.principaluri');
            $criteria->addSelectColumn($alias . '.source');
            $criteria->addSelectColumn($alias . '.displayname');
            $criteria->addSelectColumn($alias . '.refreshrate');
            $criteria->addSelectColumn($alias . '.calendarorder');
            $criteria->addSelectColumn($alias . '.calendarcolor');
            $criteria->addSelectColumn($alias . '.striptodos');
            $criteria->addSelectColumn($alias . '.stripalarms');
            $criteria->addSelectColumn($alias . '.stripattachments');
            $criteria->addSelectColumn($alias . '.lastmodified');
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
        return Propel::getServiceContainer()->getDatabaseMap(CalendarsubscriptionsTableMap::DATABASE_NAME)->getTable(CalendarsubscriptionsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CalendarsubscriptionsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CalendarsubscriptionsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CalendarsubscriptionsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Calendarsubscriptions or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Calendarsubscriptions object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarsubscriptionsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\Calendarsubscriptions) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CalendarsubscriptionsTableMap::DATABASE_NAME);
            $criteria->add(CalendarsubscriptionsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CalendarsubscriptionsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CalendarsubscriptionsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CalendarsubscriptionsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the calendarsubscriptions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CalendarsubscriptionsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Calendarsubscriptions or Criteria object.
     *
     * @param mixed               $criteria Criteria or Calendarsubscriptions object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarsubscriptionsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Calendarsubscriptions object
        }

        if ($criteria->containsKey(CalendarsubscriptionsTableMap::COL_ID) && $criteria->keyContainsValue(CalendarsubscriptionsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CalendarsubscriptionsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CalendarsubscriptionsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CalendarsubscriptionsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CalendarsubscriptionsTableMap::buildTableMap();
