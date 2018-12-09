<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\GdprInfo;
use EcclesiaCRM\GdprInfoQuery;
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
 * This class defines the structure of the 'gdpr_infos' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class GdprInfoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.GdprInfoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'gdpr_infos';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\GdprInfo';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.GdprInfo';

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
     * the column name for the gdpr_info_id field
     */
    const COL_GDPR_INFO_ID = 'gdpr_infos.gdpr_info_id';

    /**
     * the column name for the gdpr_info_About field
     */
    const COL_GDPR_INFO_ABOUT = 'gdpr_infos.gdpr_info_About';

    /**
     * the column name for the gdpr_info_Name field
     */
    const COL_GDPR_INFO_NAME = 'gdpr_infos.gdpr_info_Name';

    /**
     * the column name for the gdpr_info_Type field
     */
    const COL_GDPR_INFO_TYPE = 'gdpr_infos.gdpr_info_Type';

    /**
     * the column name for the gdpr_info_comment field
     */
    const COL_GDPR_INFO_COMMENT = 'gdpr_infos.gdpr_info_comment';

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
        self::TYPE_PHPNAME       => array('Id', 'About', 'Name', 'TypeId', 'Comment', ),
        self::TYPE_CAMELNAME     => array('id', 'about', 'name', 'typeId', 'comment', ),
        self::TYPE_COLNAME       => array(GdprInfoTableMap::COL_GDPR_INFO_ID, GdprInfoTableMap::COL_GDPR_INFO_ABOUT, GdprInfoTableMap::COL_GDPR_INFO_NAME, GdprInfoTableMap::COL_GDPR_INFO_TYPE, GdprInfoTableMap::COL_GDPR_INFO_COMMENT, ),
        self::TYPE_FIELDNAME     => array('gdpr_info_id', 'gdpr_info_About', 'gdpr_info_Name', 'gdpr_info_Type', 'gdpr_info_comment', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'About' => 1, 'Name' => 2, 'TypeId' => 3, 'Comment' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'about' => 1, 'name' => 2, 'typeId' => 3, 'comment' => 4, ),
        self::TYPE_COLNAME       => array(GdprInfoTableMap::COL_GDPR_INFO_ID => 0, GdprInfoTableMap::COL_GDPR_INFO_ABOUT => 1, GdprInfoTableMap::COL_GDPR_INFO_NAME => 2, GdprInfoTableMap::COL_GDPR_INFO_TYPE => 3, GdprInfoTableMap::COL_GDPR_INFO_COMMENT => 4, ),
        self::TYPE_FIELDNAME     => array('gdpr_info_id' => 0, 'gdpr_info_About' => 1, 'gdpr_info_Name' => 2, 'gdpr_info_Type' => 3, 'gdpr_info_comment' => 4, ),
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
        $this->setName('gdpr_infos');
        $this->setPhpName('GdprInfo');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\GdprInfo');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('gdpr_info_id', 'Id', 'SMALLINT', true, 9, null);
        $this->addColumn('gdpr_info_About', 'About', 'CHAR', true, null, 'Person');
        $this->addColumn('gdpr_info_Name', 'Name', 'VARCHAR', true, 40, '');
        $this->addColumn('gdpr_info_Type', 'TypeId', 'TINYINT', true, null, 0);
        $this->addColumn('gdpr_info_comment', 'Comment', 'LONGVARCHAR', true, null, null);
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
        return $withPrefix ? GdprInfoTableMap::CLASS_DEFAULT : GdprInfoTableMap::OM_CLASS;
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
     * @return array           (GdprInfo object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = GdprInfoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GdprInfoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GdprInfoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GdprInfoTableMap::OM_CLASS;
            /** @var GdprInfo $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GdprInfoTableMap::addInstanceToPool($obj, $key);
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
            $key = GdprInfoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GdprInfoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GdprInfo $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GdprInfoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GdprInfoTableMap::COL_GDPR_INFO_ID);
            $criteria->addSelectColumn(GdprInfoTableMap::COL_GDPR_INFO_ABOUT);
            $criteria->addSelectColumn(GdprInfoTableMap::COL_GDPR_INFO_NAME);
            $criteria->addSelectColumn(GdprInfoTableMap::COL_GDPR_INFO_TYPE);
            $criteria->addSelectColumn(GdprInfoTableMap::COL_GDPR_INFO_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.gdpr_info_id');
            $criteria->addSelectColumn($alias . '.gdpr_info_About');
            $criteria->addSelectColumn($alias . '.gdpr_info_Name');
            $criteria->addSelectColumn($alias . '.gdpr_info_Type');
            $criteria->addSelectColumn($alias . '.gdpr_info_comment');
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
        return Propel::getServiceContainer()->getDatabaseMap(GdprInfoTableMap::DATABASE_NAME)->getTable(GdprInfoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(GdprInfoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(GdprInfoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new GdprInfoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a GdprInfo or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or GdprInfo object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GdprInfoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\GdprInfo) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GdprInfoTableMap::DATABASE_NAME);
            $criteria->add(GdprInfoTableMap::COL_GDPR_INFO_ID, (array) $values, Criteria::IN);
        }

        $query = GdprInfoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GdprInfoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GdprInfoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the gdpr_infos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return GdprInfoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GdprInfo or Criteria object.
     *
     * @param mixed               $criteria Criteria or GdprInfo object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GdprInfoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GdprInfo object
        }

        if ($criteria->containsKey(GdprInfoTableMap::COL_GDPR_INFO_ID) && $criteria->keyContainsValue(GdprInfoTableMap::COL_GDPR_INFO_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GdprInfoTableMap::COL_GDPR_INFO_ID.')');
        }


        // Set the correct dbName
        $query = GdprInfoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // GdprInfoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
GdprInfoTableMap::buildTableMap();
