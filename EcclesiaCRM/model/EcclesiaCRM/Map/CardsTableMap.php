<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\Cards;
use EcclesiaCRM\CardsQuery;
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
 * This class defines the structure of the 'cards' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CardsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.CardsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'cards';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\Cards';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.Cards';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'cards.id';

    /**
     * the column name for the addressbookid field
     */
    const COL_ADDRESSBOOKID = 'cards.addressbookid';

    /**
     * the column name for the carddata field
     */
    const COL_CARDDATA = 'cards.carddata';

    /**
     * the column name for the uri field
     */
    const COL_URI = 'cards.uri';

    /**
     * the column name for the lastmodified field
     */
    const COL_LASTMODIFIED = 'cards.lastmodified';

    /**
     * the column name for the etag field
     */
    const COL_ETAG = 'cards.etag';

    /**
     * the column name for the size field
     */
    const COL_SIZE = 'cards.size';

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
        self::TYPE_PHPNAME       => array('Id', 'Addressbookid', 'Carddata', 'Uri', 'Lastmodified', 'Etag', 'Size', ),
        self::TYPE_CAMELNAME     => array('id', 'addressbookid', 'carddata', 'uri', 'lastmodified', 'etag', 'size', ),
        self::TYPE_COLNAME       => array(CardsTableMap::COL_ID, CardsTableMap::COL_ADDRESSBOOKID, CardsTableMap::COL_CARDDATA, CardsTableMap::COL_URI, CardsTableMap::COL_LASTMODIFIED, CardsTableMap::COL_ETAG, CardsTableMap::COL_SIZE, ),
        self::TYPE_FIELDNAME     => array('id', 'addressbookid', 'carddata', 'uri', 'lastmodified', 'etag', 'size', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Addressbookid' => 1, 'Carddata' => 2, 'Uri' => 3, 'Lastmodified' => 4, 'Etag' => 5, 'Size' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'addressbookid' => 1, 'carddata' => 2, 'uri' => 3, 'lastmodified' => 4, 'etag' => 5, 'size' => 6, ),
        self::TYPE_COLNAME       => array(CardsTableMap::COL_ID => 0, CardsTableMap::COL_ADDRESSBOOKID => 1, CardsTableMap::COL_CARDDATA => 2, CardsTableMap::COL_URI => 3, CardsTableMap::COL_LASTMODIFIED => 4, CardsTableMap::COL_ETAG => 5, CardsTableMap::COL_SIZE => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'addressbookid' => 1, 'carddata' => 2, 'uri' => 3, 'lastmodified' => 4, 'etag' => 5, 'size' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('cards');
        $this->setPhpName('Cards');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\Cards');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('addressbookid', 'Addressbookid', 'INTEGER', 'addressbooks', 'id', true, null, null);
        $this->addColumn('carddata', 'Carddata', 'VARBINARY', false, null, null);
        $this->addColumn('uri', 'Uri', 'VARCHAR', false, 200, null);
        $this->addColumn('lastmodified', 'Lastmodified', 'INTEGER', false, null, null);
        $this->addColumn('etag', 'Etag', 'VARCHAR', false, 32, null);
        $this->addColumn('size', 'Size', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Addressbooks', '\\EcclesiaCRM\\Addressbooks', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':addressbookid',
    1 => ':id',
  ),
), null, null, null, false);
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
        return $withPrefix ? CardsTableMap::CLASS_DEFAULT : CardsTableMap::OM_CLASS;
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
     * @return array           (Cards object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CardsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CardsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CardsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CardsTableMap::OM_CLASS;
            /** @var Cards $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CardsTableMap::addInstanceToPool($obj, $key);
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
            $key = CardsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CardsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Cards $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CardsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CardsTableMap::COL_ID);
            $criteria->addSelectColumn(CardsTableMap::COL_ADDRESSBOOKID);
            $criteria->addSelectColumn(CardsTableMap::COL_CARDDATA);
            $criteria->addSelectColumn(CardsTableMap::COL_URI);
            $criteria->addSelectColumn(CardsTableMap::COL_LASTMODIFIED);
            $criteria->addSelectColumn(CardsTableMap::COL_ETAG);
            $criteria->addSelectColumn(CardsTableMap::COL_SIZE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.addressbookid');
            $criteria->addSelectColumn($alias . '.carddata');
            $criteria->addSelectColumn($alias . '.uri');
            $criteria->addSelectColumn($alias . '.lastmodified');
            $criteria->addSelectColumn($alias . '.etag');
            $criteria->addSelectColumn($alias . '.size');
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
        return Propel::getServiceContainer()->getDatabaseMap(CardsTableMap::DATABASE_NAME)->getTable(CardsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CardsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CardsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CardsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Cards or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Cards object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CardsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\Cards) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CardsTableMap::DATABASE_NAME);
            $criteria->add(CardsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CardsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CardsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CardsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cards table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CardsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Cards or Criteria object.
     *
     * @param mixed               $criteria Criteria or Cards object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CardsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Cards object
        }

        if ($criteria->containsKey(CardsTableMap::COL_ID) && $criteria->keyContainsValue(CardsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CardsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CardsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CardsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CardsTableMap::buildTableMap();
