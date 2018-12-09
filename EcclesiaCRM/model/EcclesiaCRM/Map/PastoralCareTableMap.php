<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\PastoralCare;
use EcclesiaCRM\PastoralCareQuery;
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
 * This class defines the structure of the 'pastoral_care' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PastoralCareTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.PastoralCareTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'pastoral_care';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\PastoralCare';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.PastoralCare';

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
     * the column name for the pst_cr_id field
     */
    const COL_PST_CR_ID = 'pastoral_care.pst_cr_id';

    /**
     * the column name for the pst_cr_person_id field
     */
    const COL_PST_CR_PERSON_ID = 'pastoral_care.pst_cr_person_id';

    /**
     * the column name for the pst_cr_pastor_id field
     */
    const COL_PST_CR_PASTOR_ID = 'pastoral_care.pst_cr_pastor_id';

    /**
     * the column name for the pst_cr_pastor_Name field
     */
    const COL_PST_CR_PASTOR_NAME = 'pastoral_care.pst_cr_pastor_Name';

    /**
     * the column name for the pst_cr_Type_id field
     */
    const COL_PST_CR_TYPE_ID = 'pastoral_care.pst_cr_Type_id';

    /**
     * the column name for the pst_cr_visible field
     */
    const COL_PST_CR_VISIBLE = 'pastoral_care.pst_cr_visible';

    /**
     * the column name for the pst_cr_Text field
     */
    const COL_PST_CR_TEXT = 'pastoral_care.pst_cr_Text';

    /**
     * the column name for the pst_cr_date field
     */
    const COL_PST_CR_DATE = 'pastoral_care.pst_cr_date';

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
        self::TYPE_PHPNAME       => array('Id', 'PersonId', 'PastorId', 'PastorName', 'TypeId', 'Visible', 'Text', 'Date', ),
        self::TYPE_CAMELNAME     => array('id', 'personId', 'pastorId', 'pastorName', 'typeId', 'visible', 'text', 'date', ),
        self::TYPE_COLNAME       => array(PastoralCareTableMap::COL_PST_CR_ID, PastoralCareTableMap::COL_PST_CR_PERSON_ID, PastoralCareTableMap::COL_PST_CR_PASTOR_ID, PastoralCareTableMap::COL_PST_CR_PASTOR_NAME, PastoralCareTableMap::COL_PST_CR_TYPE_ID, PastoralCareTableMap::COL_PST_CR_VISIBLE, PastoralCareTableMap::COL_PST_CR_TEXT, PastoralCareTableMap::COL_PST_CR_DATE, ),
        self::TYPE_FIELDNAME     => array('pst_cr_id', 'pst_cr_person_id', 'pst_cr_pastor_id', 'pst_cr_pastor_Name', 'pst_cr_Type_id', 'pst_cr_visible', 'pst_cr_Text', 'pst_cr_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'PersonId' => 1, 'PastorId' => 2, 'PastorName' => 3, 'TypeId' => 4, 'Visible' => 5, 'Text' => 6, 'Date' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'personId' => 1, 'pastorId' => 2, 'pastorName' => 3, 'typeId' => 4, 'visible' => 5, 'text' => 6, 'date' => 7, ),
        self::TYPE_COLNAME       => array(PastoralCareTableMap::COL_PST_CR_ID => 0, PastoralCareTableMap::COL_PST_CR_PERSON_ID => 1, PastoralCareTableMap::COL_PST_CR_PASTOR_ID => 2, PastoralCareTableMap::COL_PST_CR_PASTOR_NAME => 3, PastoralCareTableMap::COL_PST_CR_TYPE_ID => 4, PastoralCareTableMap::COL_PST_CR_VISIBLE => 5, PastoralCareTableMap::COL_PST_CR_TEXT => 6, PastoralCareTableMap::COL_PST_CR_DATE => 7, ),
        self::TYPE_FIELDNAME     => array('pst_cr_id' => 0, 'pst_cr_person_id' => 1, 'pst_cr_pastor_id' => 2, 'pst_cr_pastor_Name' => 3, 'pst_cr_Type_id' => 4, 'pst_cr_visible' => 5, 'pst_cr_Text' => 6, 'pst_cr_date' => 7, ),
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
        $this->setName('pastoral_care');
        $this->setPhpName('PastoralCare');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\PastoralCare');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('pst_cr_id', 'Id', 'SMALLINT', true, 9, null);
        $this->addForeignKey('pst_cr_person_id', 'PersonId', 'SMALLINT', 'person_per', 'per_ID', true, 9, null);
        $this->addForeignKey('pst_cr_pastor_id', 'PastorId', 'SMALLINT', 'person_per', 'per_ID', false, 9, null);
        $this->addColumn('pst_cr_pastor_Name', 'PastorName', 'VARCHAR', true, 255, '');
        $this->addForeignKey('pst_cr_Type_id', 'TypeId', 'SMALLINT', 'pastoral_care_type', 'pst_cr_tp_id', true, 9, null);
        $this->addColumn('pst_cr_visible', 'Visible', 'BOOLEAN', true, 1, false);
        $this->addColumn('pst_cr_Text', 'Text', 'LONGVARCHAR', false, null, null);
        $this->addColumn('pst_cr_date', 'Date', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PastoralCareType', '\\EcclesiaCRM\\PastoralCareType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':pst_cr_Type_id',
    1 => ':pst_cr_tp_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('PersonRelatedByPastorId', '\\EcclesiaCRM\\Person', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':pst_cr_pastor_id',
    1 => ':per_ID',
  ),
), 'SET NULL', null, null, false);
        $this->addRelation('PersonRelatedByPersonId', '\\EcclesiaCRM\\Person', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':pst_cr_person_id',
    1 => ':per_ID',
  ),
), 'CASCADE', null, null, false);
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
        return $withPrefix ? PastoralCareTableMap::CLASS_DEFAULT : PastoralCareTableMap::OM_CLASS;
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
     * @return array           (PastoralCare object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PastoralCareTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PastoralCareTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PastoralCareTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PastoralCareTableMap::OM_CLASS;
            /** @var PastoralCare $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PastoralCareTableMap::addInstanceToPool($obj, $key);
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
            $key = PastoralCareTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PastoralCareTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PastoralCare $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PastoralCareTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PastoralCareTableMap::COL_PST_CR_ID);
            $criteria->addSelectColumn(PastoralCareTableMap::COL_PST_CR_PERSON_ID);
            $criteria->addSelectColumn(PastoralCareTableMap::COL_PST_CR_PASTOR_ID);
            $criteria->addSelectColumn(PastoralCareTableMap::COL_PST_CR_PASTOR_NAME);
            $criteria->addSelectColumn(PastoralCareTableMap::COL_PST_CR_TYPE_ID);
            $criteria->addSelectColumn(PastoralCareTableMap::COL_PST_CR_VISIBLE);
            $criteria->addSelectColumn(PastoralCareTableMap::COL_PST_CR_TEXT);
            $criteria->addSelectColumn(PastoralCareTableMap::COL_PST_CR_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.pst_cr_id');
            $criteria->addSelectColumn($alias . '.pst_cr_person_id');
            $criteria->addSelectColumn($alias . '.pst_cr_pastor_id');
            $criteria->addSelectColumn($alias . '.pst_cr_pastor_Name');
            $criteria->addSelectColumn($alias . '.pst_cr_Type_id');
            $criteria->addSelectColumn($alias . '.pst_cr_visible');
            $criteria->addSelectColumn($alias . '.pst_cr_Text');
            $criteria->addSelectColumn($alias . '.pst_cr_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(PastoralCareTableMap::DATABASE_NAME)->getTable(PastoralCareTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PastoralCareTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PastoralCareTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PastoralCareTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PastoralCare or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PastoralCare object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PastoralCareTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\PastoralCare) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PastoralCareTableMap::DATABASE_NAME);
            $criteria->add(PastoralCareTableMap::COL_PST_CR_ID, (array) $values, Criteria::IN);
        }

        $query = PastoralCareQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PastoralCareTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PastoralCareTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pastoral_care table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PastoralCareQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PastoralCare or Criteria object.
     *
     * @param mixed               $criteria Criteria or PastoralCare object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PastoralCareTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PastoralCare object
        }

        if ($criteria->containsKey(PastoralCareTableMap::COL_PST_CR_ID) && $criteria->keyContainsValue(PastoralCareTableMap::COL_PST_CR_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PastoralCareTableMap::COL_PST_CR_ID.')');
        }


        // Set the correct dbName
        $query = PastoralCareQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PastoralCareTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PastoralCareTableMap::buildTableMap();
