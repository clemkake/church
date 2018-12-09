<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\NoteShare;
use EcclesiaCRM\NoteShareQuery;
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
 * This class defines the structure of the 'note_nte_share' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class NoteShareTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.NoteShareTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'note_nte_share';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\NoteShare';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.NoteShare';

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
     * the column name for the nte_sh_id field
     */
    const COL_NTE_SH_ID = 'note_nte_share.nte_sh_id';

    /**
     * the column name for the nte_sh_note_ID field
     */
    const COL_NTE_SH_NOTE_ID = 'note_nte_share.nte_sh_note_ID';

    /**
     * the column name for the nte_sh_share_to_person_ID field
     */
    const COL_NTE_SH_SHARE_TO_PERSON_ID = 'note_nte_share.nte_sh_share_to_person_ID';

    /**
     * the column name for the nte_sh_share_to_family_ID field
     */
    const COL_NTE_SH_SHARE_TO_FAMILY_ID = 'note_nte_share.nte_sh_share_to_family_ID';

    /**
     * the column name for the nte_sh_share_rights field
     */
    const COL_NTE_SH_SHARE_RIGHTS = 'note_nte_share.nte_sh_share_rights';

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
        self::TYPE_PHPNAME       => array('Id', 'NoteId', 'SharePerId', 'ShareFamId', 'Rights', ),
        self::TYPE_CAMELNAME     => array('id', 'noteId', 'sharePerId', 'shareFamId', 'rights', ),
        self::TYPE_COLNAME       => array(NoteShareTableMap::COL_NTE_SH_ID, NoteShareTableMap::COL_NTE_SH_NOTE_ID, NoteShareTableMap::COL_NTE_SH_SHARE_TO_PERSON_ID, NoteShareTableMap::COL_NTE_SH_SHARE_TO_FAMILY_ID, NoteShareTableMap::COL_NTE_SH_SHARE_RIGHTS, ),
        self::TYPE_FIELDNAME     => array('nte_sh_id', 'nte_sh_note_ID', 'nte_sh_share_to_person_ID', 'nte_sh_share_to_family_ID', 'nte_sh_share_rights', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'NoteId' => 1, 'SharePerId' => 2, 'ShareFamId' => 3, 'Rights' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'noteId' => 1, 'sharePerId' => 2, 'shareFamId' => 3, 'rights' => 4, ),
        self::TYPE_COLNAME       => array(NoteShareTableMap::COL_NTE_SH_ID => 0, NoteShareTableMap::COL_NTE_SH_NOTE_ID => 1, NoteShareTableMap::COL_NTE_SH_SHARE_TO_PERSON_ID => 2, NoteShareTableMap::COL_NTE_SH_SHARE_TO_FAMILY_ID => 3, NoteShareTableMap::COL_NTE_SH_SHARE_RIGHTS => 4, ),
        self::TYPE_FIELDNAME     => array('nte_sh_id' => 0, 'nte_sh_note_ID' => 1, 'nte_sh_share_to_person_ID' => 2, 'nte_sh_share_to_family_ID' => 3, 'nte_sh_share_rights' => 4, ),
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
        $this->setName('note_nte_share');
        $this->setPhpName('NoteShare');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\NoteShare');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('nte_sh_id', 'Id', 'SMALLINT', true, 9, null);
        $this->addForeignKey('nte_sh_note_ID', 'NoteId', 'SMALLINT', 'note_nte', 'nte_ID', false, 9, null);
        $this->addForeignKey('nte_sh_share_to_person_ID', 'SharePerId', 'SMALLINT', 'person_per', 'per_ID', false, 9, null);
        $this->addForeignKey('nte_sh_share_to_family_ID', 'ShareFamId', 'SMALLINT', 'family_fam', 'fam_ID', false, 9, null);
        $this->addColumn('nte_sh_share_rights', 'Rights', 'SMALLINT', true, 2, 1);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Note', '\\EcclesiaCRM\\Note', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':nte_sh_note_ID',
    1 => ':nte_ID',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Family', '\\EcclesiaCRM\\Family', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':nte_sh_share_to_family_ID',
    1 => ':fam_ID',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Person', '\\EcclesiaCRM\\Person', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':nte_sh_share_to_person_ID',
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
        return $withPrefix ? NoteShareTableMap::CLASS_DEFAULT : NoteShareTableMap::OM_CLASS;
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
     * @return array           (NoteShare object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = NoteShareTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NoteShareTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NoteShareTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NoteShareTableMap::OM_CLASS;
            /** @var NoteShare $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NoteShareTableMap::addInstanceToPool($obj, $key);
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
            $key = NoteShareTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NoteShareTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var NoteShare $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NoteShareTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(NoteShareTableMap::COL_NTE_SH_ID);
            $criteria->addSelectColumn(NoteShareTableMap::COL_NTE_SH_NOTE_ID);
            $criteria->addSelectColumn(NoteShareTableMap::COL_NTE_SH_SHARE_TO_PERSON_ID);
            $criteria->addSelectColumn(NoteShareTableMap::COL_NTE_SH_SHARE_TO_FAMILY_ID);
            $criteria->addSelectColumn(NoteShareTableMap::COL_NTE_SH_SHARE_RIGHTS);
        } else {
            $criteria->addSelectColumn($alias . '.nte_sh_id');
            $criteria->addSelectColumn($alias . '.nte_sh_note_ID');
            $criteria->addSelectColumn($alias . '.nte_sh_share_to_person_ID');
            $criteria->addSelectColumn($alias . '.nte_sh_share_to_family_ID');
            $criteria->addSelectColumn($alias . '.nte_sh_share_rights');
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
        return Propel::getServiceContainer()->getDatabaseMap(NoteShareTableMap::DATABASE_NAME)->getTable(NoteShareTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(NoteShareTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(NoteShareTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new NoteShareTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a NoteShare or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or NoteShare object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(NoteShareTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\NoteShare) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NoteShareTableMap::DATABASE_NAME);
            $criteria->add(NoteShareTableMap::COL_NTE_SH_ID, (array) $values, Criteria::IN);
        }

        $query = NoteShareQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            NoteShareTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                NoteShareTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the note_nte_share table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return NoteShareQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a NoteShare or Criteria object.
     *
     * @param mixed               $criteria Criteria or NoteShare object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NoteShareTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from NoteShare object
        }

        if ($criteria->containsKey(NoteShareTableMap::COL_NTE_SH_ID) && $criteria->keyContainsValue(NoteShareTableMap::COL_NTE_SH_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NoteShareTableMap::COL_NTE_SH_ID.')');
        }


        // Set the correct dbName
        $query = NoteShareQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // NoteShareTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
NoteShareTableMap::buildTableMap();
