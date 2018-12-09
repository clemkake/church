<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\PastoralCareType;
use EcclesiaCRM\PastoralCareTypeQuery;
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
 * This class defines the structure of the 'pastoral_care_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PastoralCareTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.PastoralCareTypeTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'pastoral_care_type';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\PastoralCareType';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.PastoralCareType';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the pst_cr_tp_id field
     */
    const COL_PST_CR_TP_ID = 'pastoral_care_type.pst_cr_tp_id';

    /**
     * the column name for the pst_cr_tp_title field
     */
    const COL_PST_CR_TP_TITLE = 'pastoral_care_type.pst_cr_tp_title';

    /**
     * the column name for the pst_cr_tp_desc field
     */
    const COL_PST_CR_TP_DESC = 'pastoral_care_type.pst_cr_tp_desc';

    /**
     * the column name for the pst_cr_tp_visible field
     */
    const COL_PST_CR_TP_VISIBLE = 'pastoral_care_type.pst_cr_tp_visible';

    /**
     * the column name for the pst_cr_tp_comment field
     */
    const COL_PST_CR_TP_COMMENT = 'pastoral_care_type.pst_cr_tp_comment';

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
        self::TYPE_PHPNAME       => array('Id', 'Title', 'Desc', 'Visible', 'Comment', ),
        self::TYPE_CAMELNAME     => array('id', 'title', 'desc', 'visible', 'comment', ),
        self::TYPE_COLNAME       => array(PastoralCareTypeTableMap::COL_PST_CR_TP_ID, PastoralCareTypeTableMap::COL_PST_CR_TP_TITLE, PastoralCareTypeTableMap::COL_PST_CR_TP_DESC, PastoralCareTypeTableMap::COL_PST_CR_TP_VISIBLE, PastoralCareTypeTableMap::COL_PST_CR_TP_COMMENT, ),
        self::TYPE_FIELDNAME     => array('pst_cr_tp_id', 'pst_cr_tp_title', 'pst_cr_tp_desc', 'pst_cr_tp_visible', 'pst_cr_tp_comment', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Title' => 1, 'Desc' => 2, 'Visible' => 3, 'Comment' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'title' => 1, 'desc' => 2, 'visible' => 3, 'comment' => 4, ),
        self::TYPE_COLNAME       => array(PastoralCareTypeTableMap::COL_PST_CR_TP_ID => 0, PastoralCareTypeTableMap::COL_PST_CR_TP_TITLE => 1, PastoralCareTypeTableMap::COL_PST_CR_TP_DESC => 2, PastoralCareTypeTableMap::COL_PST_CR_TP_VISIBLE => 3, PastoralCareTypeTableMap::COL_PST_CR_TP_COMMENT => 4, ),
        self::TYPE_FIELDNAME     => array('pst_cr_tp_id' => 0, 'pst_cr_tp_title' => 1, 'pst_cr_tp_desc' => 2, 'pst_cr_tp_visible' => 3, 'pst_cr_tp_comment' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('pastoral_care_type');
        $this->setPhpName('PastoralCareType');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\PastoralCareType');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('pst_cr_tp_id', 'Id', 'SMALLINT', true, 9, null);
        $this->addColumn('pst_cr_tp_title', 'Title', 'VARCHAR', true, 255, '');
        $this->addColumn('pst_cr_tp_desc', 'Desc', 'VARCHAR', true, 255, '');
        $this->addColumn('pst_cr_tp_visible', 'Visible', 'BOOLEAN', true, 1, false);
        $this->addColumn('pst_cr_tp_comment', 'Comment', 'LONGVARCHAR', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PastoralCare', '\\EcclesiaCRM\\PastoralCare', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':pst_cr_Type_id',
    1 => ':pst_cr_tp_id',
  ),
), 'CASCADE', null, 'PastoralCares', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to pastoral_care_type     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        PastoralCareTableMap::clearInstancePool();
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
        return $withPrefix ? PastoralCareTypeTableMap::CLASS_DEFAULT : PastoralCareTypeTableMap::OM_CLASS;
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
     * @return array           (PastoralCareType object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PastoralCareTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PastoralCareTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PastoralCareTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PastoralCareTypeTableMap::OM_CLASS;
            /** @var PastoralCareType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PastoralCareTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = PastoralCareTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PastoralCareTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PastoralCareType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PastoralCareTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PastoralCareTypeTableMap::COL_PST_CR_TP_ID);
            $criteria->addSelectColumn(PastoralCareTypeTableMap::COL_PST_CR_TP_TITLE);
            $criteria->addSelectColumn(PastoralCareTypeTableMap::COL_PST_CR_TP_DESC);
            $criteria->addSelectColumn(PastoralCareTypeTableMap::COL_PST_CR_TP_VISIBLE);
            $criteria->addSelectColumn(PastoralCareTypeTableMap::COL_PST_CR_TP_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.pst_cr_tp_id');
            $criteria->addSelectColumn($alias . '.pst_cr_tp_title');
            $criteria->addSelectColumn($alias . '.pst_cr_tp_desc');
            $criteria->addSelectColumn($alias . '.pst_cr_tp_visible');
            $criteria->addSelectColumn($alias . '.pst_cr_tp_comment');
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
        return Propel::getServiceContainer()->getDatabaseMap(PastoralCareTypeTableMap::DATABASE_NAME)->getTable(PastoralCareTypeTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PastoralCareTypeTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PastoralCareTypeTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PastoralCareTypeTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PastoralCareType or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PastoralCareType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PastoralCareTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\PastoralCareType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PastoralCareTypeTableMap::DATABASE_NAME);
            $criteria->add(PastoralCareTypeTableMap::COL_PST_CR_TP_ID, (array) $values, Criteria::IN);
        }

        $query = PastoralCareTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PastoralCareTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PastoralCareTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pastoral_care_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PastoralCareTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PastoralCareType or Criteria object.
     *
     * @param mixed               $criteria Criteria or PastoralCareType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PastoralCareTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PastoralCareType object
        }

        if ($criteria->containsKey(PastoralCareTypeTableMap::COL_PST_CR_TP_ID) && $criteria->keyContainsValue(PastoralCareTypeTableMap::COL_PST_CR_TP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PastoralCareTypeTableMap::COL_PST_CR_TP_ID.')');
        }


        // Set the correct dbName
        $query = PastoralCareTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PastoralCareTypeTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PastoralCareTypeTableMap::buildTableMap();
