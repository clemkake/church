<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\Locks;
use EcclesiaCRM\LocksQuery;
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
 * This class defines the structure of the 'locks' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class LocksTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.LocksTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'locks';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\Locks';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.Locks';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'locks.id';

    /**
     * the column name for the owner field
     */
    const COL_OWNER = 'locks.owner';

    /**
     * the column name for the timeout field
     */
    const COL_TIMEOUT = 'locks.timeout';

    /**
     * the column name for the created field
     */
    const COL_CREATED = 'locks.created';

    /**
     * the column name for the token field
     */
    const COL_TOKEN = 'locks.token';

    /**
     * the column name for the scope field
     */
    const COL_SCOPE = 'locks.scope';

    /**
     * the column name for the depth field
     */
    const COL_DEPTH = 'locks.depth';

    /**
     * the column name for the uri field
     */
    const COL_URI = 'locks.uri';

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
        self::TYPE_PHPNAME       => array('Id', 'Owner', 'Timeout', 'Created', 'Token', 'Scope', 'Depth', 'Uri', ),
        self::TYPE_CAMELNAME     => array('id', 'owner', 'timeout', 'created', 'token', 'scope', 'depth', 'uri', ),
        self::TYPE_COLNAME       => array(LocksTableMap::COL_ID, LocksTableMap::COL_OWNER, LocksTableMap::COL_TIMEOUT, LocksTableMap::COL_CREATED, LocksTableMap::COL_TOKEN, LocksTableMap::COL_SCOPE, LocksTableMap::COL_DEPTH, LocksTableMap::COL_URI, ),
        self::TYPE_FIELDNAME     => array('id', 'owner', 'timeout', 'created', 'token', 'scope', 'depth', 'uri', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Owner' => 1, 'Timeout' => 2, 'Created' => 3, 'Token' => 4, 'Scope' => 5, 'Depth' => 6, 'Uri' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'owner' => 1, 'timeout' => 2, 'created' => 3, 'token' => 4, 'scope' => 5, 'depth' => 6, 'uri' => 7, ),
        self::TYPE_COLNAME       => array(LocksTableMap::COL_ID => 0, LocksTableMap::COL_OWNER => 1, LocksTableMap::COL_TIMEOUT => 2, LocksTableMap::COL_CREATED => 3, LocksTableMap::COL_TOKEN => 4, LocksTableMap::COL_SCOPE => 5, LocksTableMap::COL_DEPTH => 6, LocksTableMap::COL_URI => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'owner' => 1, 'timeout' => 2, 'created' => 3, 'token' => 4, 'scope' => 5, 'depth' => 6, 'uri' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('locks');
        $this->setPhpName('Locks');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\Locks');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addColumn('owner', 'Owner', 'VARCHAR', false, 100, null);
        $this->addColumn('timeout', 'Timeout', 'INTEGER', false, 10, null);
        $this->addColumn('created', 'Created', 'INTEGER', false, null, null);
        $this->addColumn('token', 'Token', 'VARCHAR', false, 100, null);
        $this->addColumn('scope', 'Scope', 'TINYINT', false, null, null);
        $this->addColumn('depth', 'Depth', 'TINYINT', false, null, null);
        $this->addColumn('uri', 'Uri', 'VARCHAR', false, 1000, null);
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
        return $withPrefix ? LocksTableMap::CLASS_DEFAULT : LocksTableMap::OM_CLASS;
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
     * @return array           (Locks object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LocksTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LocksTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LocksTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LocksTableMap::OM_CLASS;
            /** @var Locks $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LocksTableMap::addInstanceToPool($obj, $key);
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
            $key = LocksTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LocksTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Locks $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LocksTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LocksTableMap::COL_ID);
            $criteria->addSelectColumn(LocksTableMap::COL_OWNER);
            $criteria->addSelectColumn(LocksTableMap::COL_TIMEOUT);
            $criteria->addSelectColumn(LocksTableMap::COL_CREATED);
            $criteria->addSelectColumn(LocksTableMap::COL_TOKEN);
            $criteria->addSelectColumn(LocksTableMap::COL_SCOPE);
            $criteria->addSelectColumn(LocksTableMap::COL_DEPTH);
            $criteria->addSelectColumn(LocksTableMap::COL_URI);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.owner');
            $criteria->addSelectColumn($alias . '.timeout');
            $criteria->addSelectColumn($alias . '.created');
            $criteria->addSelectColumn($alias . '.token');
            $criteria->addSelectColumn($alias . '.scope');
            $criteria->addSelectColumn($alias . '.depth');
            $criteria->addSelectColumn($alias . '.uri');
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
        return Propel::getServiceContainer()->getDatabaseMap(LocksTableMap::DATABASE_NAME)->getTable(LocksTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LocksTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(LocksTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new LocksTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Locks or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Locks object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LocksTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\Locks) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LocksTableMap::DATABASE_NAME);
            $criteria->add(LocksTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LocksQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LocksTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LocksTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the locks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LocksQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Locks or Criteria object.
     *
     * @param mixed               $criteria Criteria or Locks object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LocksTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Locks object
        }

        if ($criteria->containsKey(LocksTableMap::COL_ID) && $criteria->keyContainsValue(LocksTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LocksTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LocksQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LocksTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
LocksTableMap::buildTableMap();
