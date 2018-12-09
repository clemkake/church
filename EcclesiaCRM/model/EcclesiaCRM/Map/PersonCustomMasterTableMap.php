<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\PersonCustomMaster;
use EcclesiaCRM\PersonCustomMasterQuery;
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
 * This class defines the structure of the 'person_custom_master' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PersonCustomMasterTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.PersonCustomMasterTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'person_custom_master';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\PersonCustomMaster';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.PersonCustomMaster';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the custom_id field
     */
    const COL_CUSTOM_ID = 'person_custom_master.custom_id';

    /**
     * the column name for the custom_Order field
     */
    const COL_CUSTOM_ORDER = 'person_custom_master.custom_Order';

    /**
     * the column name for the custom_Field field
     */
    const COL_CUSTOM_FIELD = 'person_custom_master.custom_Field';

    /**
     * the column name for the custom_Name field
     */
    const COL_CUSTOM_NAME = 'person_custom_master.custom_Name';

    /**
     * the column name for the custom_Special field
     */
    const COL_CUSTOM_SPECIAL = 'person_custom_master.custom_Special';

    /**
     * the column name for the custom_Side field
     */
    const COL_CUSTOM_SIDE = 'person_custom_master.custom_Side';

    /**
     * the column name for the custom_FieldSec field
     */
    const COL_CUSTOM_FIELDSEC = 'person_custom_master.custom_FieldSec';

    /**
     * the column name for the custom_comment field
     */
    const COL_CUSTOM_COMMENT = 'person_custom_master.custom_comment';

    /**
     * the column name for the type_ID field
     */
    const COL_TYPE_ID = 'person_custom_master.type_ID';

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
        self::TYPE_PHPNAME       => array('Id', 'CustomOrder', 'CustomField', 'CustomName', 'CustomSpecial', 'CustomSide', 'CustomFieldSec', 'CustomComment', 'TypeId', ),
        self::TYPE_CAMELNAME     => array('id', 'customOrder', 'customField', 'customName', 'customSpecial', 'customSide', 'customFieldSec', 'customComment', 'typeId', ),
        self::TYPE_COLNAME       => array(PersonCustomMasterTableMap::COL_CUSTOM_ID, PersonCustomMasterTableMap::COL_CUSTOM_ORDER, PersonCustomMasterTableMap::COL_CUSTOM_FIELD, PersonCustomMasterTableMap::COL_CUSTOM_NAME, PersonCustomMasterTableMap::COL_CUSTOM_SPECIAL, PersonCustomMasterTableMap::COL_CUSTOM_SIDE, PersonCustomMasterTableMap::COL_CUSTOM_FIELDSEC, PersonCustomMasterTableMap::COL_CUSTOM_COMMENT, PersonCustomMasterTableMap::COL_TYPE_ID, ),
        self::TYPE_FIELDNAME     => array('custom_id', 'custom_Order', 'custom_Field', 'custom_Name', 'custom_Special', 'custom_Side', 'custom_FieldSec', 'custom_comment', 'type_ID', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'CustomOrder' => 1, 'CustomField' => 2, 'CustomName' => 3, 'CustomSpecial' => 4, 'CustomSide' => 5, 'CustomFieldSec' => 6, 'CustomComment' => 7, 'TypeId' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'customOrder' => 1, 'customField' => 2, 'customName' => 3, 'customSpecial' => 4, 'customSide' => 5, 'customFieldSec' => 6, 'customComment' => 7, 'typeId' => 8, ),
        self::TYPE_COLNAME       => array(PersonCustomMasterTableMap::COL_CUSTOM_ID => 0, PersonCustomMasterTableMap::COL_CUSTOM_ORDER => 1, PersonCustomMasterTableMap::COL_CUSTOM_FIELD => 2, PersonCustomMasterTableMap::COL_CUSTOM_NAME => 3, PersonCustomMasterTableMap::COL_CUSTOM_SPECIAL => 4, PersonCustomMasterTableMap::COL_CUSTOM_SIDE => 5, PersonCustomMasterTableMap::COL_CUSTOM_FIELDSEC => 6, PersonCustomMasterTableMap::COL_CUSTOM_COMMENT => 7, PersonCustomMasterTableMap::COL_TYPE_ID => 8, ),
        self::TYPE_FIELDNAME     => array('custom_id' => 0, 'custom_Order' => 1, 'custom_Field' => 2, 'custom_Name' => 3, 'custom_Special' => 4, 'custom_Side' => 5, 'custom_FieldSec' => 6, 'custom_comment' => 7, 'type_ID' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('person_custom_master');
        $this->setPhpName('PersonCustomMaster');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\PersonCustomMaster');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('custom_id', 'Id', 'SMALLINT', true, 9, null);
        $this->addColumn('custom_Order', 'CustomOrder', 'SMALLINT', true, null, 0);
        $this->addPrimaryKey('custom_Field', 'CustomField', 'VARCHAR', true, 5, '');
        $this->addColumn('custom_Name', 'CustomName', 'VARCHAR', true, 40, '');
        $this->addColumn('custom_Special', 'CustomSpecial', 'SMALLINT', false, 8, null);
        $this->addColumn('custom_Side', 'CustomSide', 'CHAR', true, null, 'left');
        $this->addColumn('custom_FieldSec', 'CustomFieldSec', 'TINYINT', true, null, null);
        $this->addColumn('custom_comment', 'CustomComment', 'LONGVARCHAR', true, null, null);
        $this->addColumn('type_ID', 'TypeId', 'TINYINT', true, null, 0);
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
     * @param \EcclesiaCRM\PersonCustomMaster $obj A \EcclesiaCRM\PersonCustomMaster object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getId() || is_scalar($obj->getId()) || is_callable([$obj->getId(), '__toString']) ? (string) $obj->getId() : $obj->getId()), (null === $obj->getCustomField() || is_scalar($obj->getCustomField()) || is_callable([$obj->getCustomField(), '__toString']) ? (string) $obj->getCustomField() : $obj->getCustomField())]);
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
     * @param mixed $value A \EcclesiaCRM\PersonCustomMaster object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \EcclesiaCRM\PersonCustomMaster) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getCustomField() || is_scalar($value->getCustomField()) || is_callable([$value->getCustomField(), '__toString']) ? (string) $value->getCustomField() : $value->getCustomField())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \EcclesiaCRM\PersonCustomMaster object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('CustomField', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('CustomField', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('CustomField', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('CustomField', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('CustomField', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('CustomField', TableMap::TYPE_PHPNAME, $indexType)])]);
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('CustomField', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PersonCustomMasterTableMap::CLASS_DEFAULT : PersonCustomMasterTableMap::OM_CLASS;
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
     * @return array           (PersonCustomMaster object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PersonCustomMasterTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PersonCustomMasterTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PersonCustomMasterTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PersonCustomMasterTableMap::OM_CLASS;
            /** @var PersonCustomMaster $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PersonCustomMasterTableMap::addInstanceToPool($obj, $key);
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
            $key = PersonCustomMasterTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PersonCustomMasterTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PersonCustomMaster $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PersonCustomMasterTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PersonCustomMasterTableMap::COL_CUSTOM_ID);
            $criteria->addSelectColumn(PersonCustomMasterTableMap::COL_CUSTOM_ORDER);
            $criteria->addSelectColumn(PersonCustomMasterTableMap::COL_CUSTOM_FIELD);
            $criteria->addSelectColumn(PersonCustomMasterTableMap::COL_CUSTOM_NAME);
            $criteria->addSelectColumn(PersonCustomMasterTableMap::COL_CUSTOM_SPECIAL);
            $criteria->addSelectColumn(PersonCustomMasterTableMap::COL_CUSTOM_SIDE);
            $criteria->addSelectColumn(PersonCustomMasterTableMap::COL_CUSTOM_FIELDSEC);
            $criteria->addSelectColumn(PersonCustomMasterTableMap::COL_CUSTOM_COMMENT);
            $criteria->addSelectColumn(PersonCustomMasterTableMap::COL_TYPE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.custom_id');
            $criteria->addSelectColumn($alias . '.custom_Order');
            $criteria->addSelectColumn($alias . '.custom_Field');
            $criteria->addSelectColumn($alias . '.custom_Name');
            $criteria->addSelectColumn($alias . '.custom_Special');
            $criteria->addSelectColumn($alias . '.custom_Side');
            $criteria->addSelectColumn($alias . '.custom_FieldSec');
            $criteria->addSelectColumn($alias . '.custom_comment');
            $criteria->addSelectColumn($alias . '.type_ID');
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
        return Propel::getServiceContainer()->getDatabaseMap(PersonCustomMasterTableMap::DATABASE_NAME)->getTable(PersonCustomMasterTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PersonCustomMasterTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PersonCustomMasterTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PersonCustomMasterTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PersonCustomMaster or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PersonCustomMaster object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PersonCustomMasterTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\PersonCustomMaster) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PersonCustomMasterTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(PersonCustomMasterTableMap::COL_CUSTOM_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(PersonCustomMasterTableMap::COL_CUSTOM_FIELD, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = PersonCustomMasterQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PersonCustomMasterTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PersonCustomMasterTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the person_custom_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PersonCustomMasterQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PersonCustomMaster or Criteria object.
     *
     * @param mixed               $criteria Criteria or PersonCustomMaster object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonCustomMasterTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PersonCustomMaster object
        }

        if ($criteria->containsKey(PersonCustomMasterTableMap::COL_CUSTOM_ID) && $criteria->keyContainsValue(PersonCustomMasterTableMap::COL_CUSTOM_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PersonCustomMasterTableMap::COL_CUSTOM_ID.')');
        }


        // Set the correct dbName
        $query = PersonCustomMasterQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PersonCustomMasterTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PersonCustomMasterTableMap::buildTableMap();
