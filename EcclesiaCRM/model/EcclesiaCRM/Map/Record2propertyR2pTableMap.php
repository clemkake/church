<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\Record2propertyR2p;
use EcclesiaCRM\Record2propertyR2pQuery;
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
 * This class defines the structure of the 'record2property_r2p' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class Record2propertyR2pTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.Record2propertyR2pTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'record2property_r2p';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\Record2propertyR2p';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.Record2propertyR2p';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the r2p_id field
     */
    const COL_R2P_ID = 'record2property_r2p.r2p_id';

    /**
     * the column name for the r2p_pro_ID field
     */
    const COL_R2P_PRO_ID = 'record2property_r2p.r2p_pro_ID';

    /**
     * the column name for the r2p_record_ID field
     */
    const COL_R2P_RECORD_ID = 'record2property_r2p.r2p_record_ID';

    /**
     * the column name for the r2p_Value field
     */
    const COL_R2P_VALUE = 'record2property_r2p.r2p_Value';

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
        self::TYPE_PHPNAME       => array('R2pId', 'R2pProId', 'R2pRecordId', 'R2pValue', ),
        self::TYPE_CAMELNAME     => array('r2pId', 'r2pProId', 'r2pRecordId', 'r2pValue', ),
        self::TYPE_COLNAME       => array(Record2propertyR2pTableMap::COL_R2P_ID, Record2propertyR2pTableMap::COL_R2P_PRO_ID, Record2propertyR2pTableMap::COL_R2P_RECORD_ID, Record2propertyR2pTableMap::COL_R2P_VALUE, ),
        self::TYPE_FIELDNAME     => array('r2p_id', 'r2p_pro_ID', 'r2p_record_ID', 'r2p_Value', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('R2pId' => 0, 'R2pProId' => 1, 'R2pRecordId' => 2, 'R2pValue' => 3, ),
        self::TYPE_CAMELNAME     => array('r2pId' => 0, 'r2pProId' => 1, 'r2pRecordId' => 2, 'r2pValue' => 3, ),
        self::TYPE_COLNAME       => array(Record2propertyR2pTableMap::COL_R2P_ID => 0, Record2propertyR2pTableMap::COL_R2P_PRO_ID => 1, Record2propertyR2pTableMap::COL_R2P_RECORD_ID => 2, Record2propertyR2pTableMap::COL_R2P_VALUE => 3, ),
        self::TYPE_FIELDNAME     => array('r2p_id' => 0, 'r2p_pro_ID' => 1, 'r2p_record_ID' => 2, 'r2p_Value' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
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
        $this->setName('record2property_r2p');
        $this->setPhpName('Record2propertyR2p');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\Record2propertyR2p');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('r2p_id', 'R2pId', 'SMALLINT', true, 9, null);
        $this->addPrimaryKey('r2p_pro_ID', 'R2pProId', 'SMALLINT', true, 8, 0);
        $this->addPrimaryKey('r2p_record_ID', 'R2pRecordId', 'SMALLINT', true, 8, 0);
        $this->addColumn('r2p_Value', 'R2pValue', 'LONGVARCHAR', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \EcclesiaCRM\Record2propertyR2p $obj A \EcclesiaCRM\Record2propertyR2p object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getR2pId() || is_scalar($obj->getR2pId()) || is_callable([$obj->getR2pId(), '__toString']) ? (string) $obj->getR2pId() : $obj->getR2pId()), (null === $obj->getR2pProId() || is_scalar($obj->getR2pProId()) || is_callable([$obj->getR2pProId(), '__toString']) ? (string) $obj->getR2pProId() : $obj->getR2pProId()), (null === $obj->getR2pRecordId() || is_scalar($obj->getR2pRecordId()) || is_callable([$obj->getR2pRecordId(), '__toString']) ? (string) $obj->getR2pRecordId() : $obj->getR2pRecordId())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \EcclesiaCRM\Record2propertyR2p object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \EcclesiaCRM\Record2propertyR2p) {
                $key = serialize([(null === $value->getR2pId() || is_scalar($value->getR2pId()) || is_callable([$value->getR2pId(), '__toString']) ? (string) $value->getR2pId() : $value->getR2pId()), (null === $value->getR2pProId() || is_scalar($value->getR2pProId()) || is_callable([$value->getR2pProId(), '__toString']) ? (string) $value->getR2pProId() : $value->getR2pProId()), (null === $value->getR2pRecordId() || is_scalar($value->getR2pRecordId()) || is_callable([$value->getR2pRecordId(), '__toString']) ? (string) $value->getR2pRecordId() : $value->getR2pRecordId())]);

            } elseif (is_array($value) && count($value) === 3) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1]), (null === $value[2] || is_scalar($value[2]) || is_callable([$value[2], '__toString']) ? (string) $value[2] : $value[2])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \EcclesiaCRM\Record2propertyR2p object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('R2pId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('R2pProId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('R2pRecordId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('R2pId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('R2pId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('R2pId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('R2pId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('R2pId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('R2pProId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('R2pProId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('R2pProId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('R2pProId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('R2pProId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('R2pRecordId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('R2pRecordId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('R2pRecordId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('R2pRecordId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('R2pRecordId', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('R2pId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('R2pProId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('R2pRecordId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? Record2propertyR2pTableMap::CLASS_DEFAULT : Record2propertyR2pTableMap::OM_CLASS;
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
     * @return array           (Record2propertyR2p object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = Record2propertyR2pTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = Record2propertyR2pTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + Record2propertyR2pTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = Record2propertyR2pTableMap::OM_CLASS;
            /** @var Record2propertyR2p $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            Record2propertyR2pTableMap::addInstanceToPool($obj, $key);
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
            $key = Record2propertyR2pTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = Record2propertyR2pTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Record2propertyR2p $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                Record2propertyR2pTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(Record2propertyR2pTableMap::COL_R2P_ID);
            $criteria->addSelectColumn(Record2propertyR2pTableMap::COL_R2P_PRO_ID);
            $criteria->addSelectColumn(Record2propertyR2pTableMap::COL_R2P_RECORD_ID);
            $criteria->addSelectColumn(Record2propertyR2pTableMap::COL_R2P_VALUE);
        } else {
            $criteria->addSelectColumn($alias . '.r2p_id');
            $criteria->addSelectColumn($alias . '.r2p_pro_ID');
            $criteria->addSelectColumn($alias . '.r2p_record_ID');
            $criteria->addSelectColumn($alias . '.r2p_Value');
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
        return Propel::getServiceContainer()->getDatabaseMap(Record2propertyR2pTableMap::DATABASE_NAME)->getTable(Record2propertyR2pTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(Record2propertyR2pTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(Record2propertyR2pTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new Record2propertyR2pTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Record2propertyR2p or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Record2propertyR2p object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(Record2propertyR2pTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\Record2propertyR2p) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(Record2propertyR2pTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(Record2propertyR2pTableMap::COL_R2P_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(Record2propertyR2pTableMap::COL_R2P_PRO_ID, $value[1]));
                $criterion->addAnd($criteria->getNewCriterion(Record2propertyR2pTableMap::COL_R2P_RECORD_ID, $value[2]));
                $criteria->addOr($criterion);
            }
        }

        $query = Record2propertyR2pQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            Record2propertyR2pTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                Record2propertyR2pTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the record2property_r2p table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return Record2propertyR2pQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Record2propertyR2p or Criteria object.
     *
     * @param mixed               $criteria Criteria or Record2propertyR2p object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(Record2propertyR2pTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Record2propertyR2p object
        }

        if ($criteria->containsKey(Record2propertyR2pTableMap::COL_R2P_ID) && $criteria->keyContainsValue(Record2propertyR2pTableMap::COL_R2P_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.Record2propertyR2pTableMap::COL_R2P_ID.')');
        }


        // Set the correct dbName
        $query = Record2propertyR2pQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // Record2propertyR2pTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
Record2propertyR2pTableMap::buildTableMap();
