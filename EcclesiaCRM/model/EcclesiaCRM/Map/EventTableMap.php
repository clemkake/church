<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\Event;
use EcclesiaCRM\EventQuery;
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
 * This class defines the structure of the 'events_event' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EventTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.EventTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'events_event';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\Event';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.Event';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 21;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 21;

    /**
     * the column name for the event_id field
     */
    const COL_EVENT_ID = 'events_event.event_id';

    /**
     * the column name for the event_type field
     */
    const COL_EVENT_TYPE = 'events_event.event_type';

    /**
     * the column name for the event_title field
     */
    const COL_EVENT_TITLE = 'events_event.event_title';

    /**
     * the column name for the event_desc field
     */
    const COL_EVENT_DESC = 'events_event.event_desc';

    /**
     * the column name for the event_text field
     */
    const COL_EVENT_TEXT = 'events_event.event_text';

    /**
     * the column name for the event_start field
     */
    const COL_EVENT_START = 'events_event.event_start';

    /**
     * the column name for the event_end field
     */
    const COL_EVENT_END = 'events_event.event_end';

    /**
     * the column name for the inactive field
     */
    const COL_INACTIVE = 'events_event.inactive';

    /**
     * the column name for the event_typename field
     */
    const COL_EVENT_TYPENAME = 'events_event.event_typename';

    /**
     * the column name for the event_grpid field
     */
    const COL_EVENT_GRPID = 'events_event.event_grpid';

    /**
     * the column name for the event_last_occurence field
     */
    const COL_EVENT_LAST_OCCURENCE = 'events_event.event_last_occurence';

    /**
     * the column name for the event_location field
     */
    const COL_EVENT_LOCATION = 'events_event.event_location';

    /**
     * the column name for the event_coordinates field
     */
    const COL_EVENT_COORDINATES = 'events_event.event_coordinates';

    /**
     * the column name for the event_calendardata field
     */
    const COL_EVENT_CALENDARDATA = 'events_event.event_calendardata';

    /**
     * the column name for the event_uri field
     */
    const COL_EVENT_URI = 'events_event.event_uri';

    /**
     * the column name for the event_calendarid field
     */
    const COL_EVENT_CALENDARID = 'events_event.event_calendarid';

    /**
     * the column name for the event_lastmodified field
     */
    const COL_EVENT_LASTMODIFIED = 'events_event.event_lastmodified';

    /**
     * the column name for the event_etag field
     */
    const COL_EVENT_ETAG = 'events_event.event_etag';

    /**
     * the column name for the event_size field
     */
    const COL_EVENT_SIZE = 'events_event.event_size';

    /**
     * the column name for the event_componenttype field
     */
    const COL_EVENT_COMPONENTTYPE = 'events_event.event_componenttype';

    /**
     * the column name for the event_uid field
     */
    const COL_EVENT_UID = 'events_event.event_uid';

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
        self::TYPE_PHPNAME       => array('Id', 'Type', 'Title', 'Desc', 'Text', 'Start', 'End', 'InActive', 'TypeName', 'GroupId', 'LastOccurence', 'Location', 'Coordinates', 'Calendardata', 'Uri', 'EventCalendarid', 'Lastmodified', 'Etag', 'Size', 'Componenttype', 'Uid', ),
        self::TYPE_CAMELNAME     => array('id', 'type', 'title', 'desc', 'text', 'start', 'end', 'inActive', 'typeName', 'groupId', 'lastOccurence', 'location', 'coordinates', 'calendardata', 'uri', 'eventCalendarid', 'lastmodified', 'etag', 'size', 'componenttype', 'uid', ),
        self::TYPE_COLNAME       => array(EventTableMap::COL_EVENT_ID, EventTableMap::COL_EVENT_TYPE, EventTableMap::COL_EVENT_TITLE, EventTableMap::COL_EVENT_DESC, EventTableMap::COL_EVENT_TEXT, EventTableMap::COL_EVENT_START, EventTableMap::COL_EVENT_END, EventTableMap::COL_INACTIVE, EventTableMap::COL_EVENT_TYPENAME, EventTableMap::COL_EVENT_GRPID, EventTableMap::COL_EVENT_LAST_OCCURENCE, EventTableMap::COL_EVENT_LOCATION, EventTableMap::COL_EVENT_COORDINATES, EventTableMap::COL_EVENT_CALENDARDATA, EventTableMap::COL_EVENT_URI, EventTableMap::COL_EVENT_CALENDARID, EventTableMap::COL_EVENT_LASTMODIFIED, EventTableMap::COL_EVENT_ETAG, EventTableMap::COL_EVENT_SIZE, EventTableMap::COL_EVENT_COMPONENTTYPE, EventTableMap::COL_EVENT_UID, ),
        self::TYPE_FIELDNAME     => array('event_id', 'event_type', 'event_title', 'event_desc', 'event_text', 'event_start', 'event_end', 'inactive', 'event_typename', 'event_grpid', 'event_last_occurence', 'event_location', 'event_coordinates', 'event_calendardata', 'event_uri', 'event_calendarid', 'event_lastmodified', 'event_etag', 'event_size', 'event_componenttype', 'event_uid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Type' => 1, 'Title' => 2, 'Desc' => 3, 'Text' => 4, 'Start' => 5, 'End' => 6, 'InActive' => 7, 'TypeName' => 8, 'GroupId' => 9, 'LastOccurence' => 10, 'Location' => 11, 'Coordinates' => 12, 'Calendardata' => 13, 'Uri' => 14, 'EventCalendarid' => 15, 'Lastmodified' => 16, 'Etag' => 17, 'Size' => 18, 'Componenttype' => 19, 'Uid' => 20, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'type' => 1, 'title' => 2, 'desc' => 3, 'text' => 4, 'start' => 5, 'end' => 6, 'inActive' => 7, 'typeName' => 8, 'groupId' => 9, 'lastOccurence' => 10, 'location' => 11, 'coordinates' => 12, 'calendardata' => 13, 'uri' => 14, 'eventCalendarid' => 15, 'lastmodified' => 16, 'etag' => 17, 'size' => 18, 'componenttype' => 19, 'uid' => 20, ),
        self::TYPE_COLNAME       => array(EventTableMap::COL_EVENT_ID => 0, EventTableMap::COL_EVENT_TYPE => 1, EventTableMap::COL_EVENT_TITLE => 2, EventTableMap::COL_EVENT_DESC => 3, EventTableMap::COL_EVENT_TEXT => 4, EventTableMap::COL_EVENT_START => 5, EventTableMap::COL_EVENT_END => 6, EventTableMap::COL_INACTIVE => 7, EventTableMap::COL_EVENT_TYPENAME => 8, EventTableMap::COL_EVENT_GRPID => 9, EventTableMap::COL_EVENT_LAST_OCCURENCE => 10, EventTableMap::COL_EVENT_LOCATION => 11, EventTableMap::COL_EVENT_COORDINATES => 12, EventTableMap::COL_EVENT_CALENDARDATA => 13, EventTableMap::COL_EVENT_URI => 14, EventTableMap::COL_EVENT_CALENDARID => 15, EventTableMap::COL_EVENT_LASTMODIFIED => 16, EventTableMap::COL_EVENT_ETAG => 17, EventTableMap::COL_EVENT_SIZE => 18, EventTableMap::COL_EVENT_COMPONENTTYPE => 19, EventTableMap::COL_EVENT_UID => 20, ),
        self::TYPE_FIELDNAME     => array('event_id' => 0, 'event_type' => 1, 'event_title' => 2, 'event_desc' => 3, 'event_text' => 4, 'event_start' => 5, 'event_end' => 6, 'inactive' => 7, 'event_typename' => 8, 'event_grpid' => 9, 'event_last_occurence' => 10, 'event_location' => 11, 'event_coordinates' => 12, 'event_calendardata' => 13, 'event_uri' => 14, 'event_calendarid' => 15, 'event_lastmodified' => 16, 'event_etag' => 17, 'event_size' => 18, 'event_componenttype' => 19, 'event_uid' => 20, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
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
        $this->setName('events_event');
        $this->setPhpName('Event');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\Event');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('event_id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('event_type', 'Type', 'INTEGER', true, null, 0);
        $this->addColumn('event_title', 'Title', 'VARCHAR', true, 255, '');
        $this->addColumn('event_desc', 'Desc', 'VARCHAR', false, 255, null);
        $this->addColumn('event_text', 'Text', 'LONGVARCHAR', false, null, null);
        $this->addColumn('event_start', 'Start', 'TIMESTAMP', true, null, null);
        $this->addColumn('event_end', 'End', 'TIMESTAMP', true, null, null);
        $this->addColumn('inactive', 'InActive', 'INTEGER', true, 1, 0);
        $this->addColumn('event_typename', 'TypeName', 'VARCHAR', true, 40, '');
        $this->addForeignKey('event_grpid', 'GroupId', 'INTEGER', 'group_grp', 'grp_ID', false, null, 0);
        $this->addColumn('event_last_occurence', 'LastOccurence', 'TIMESTAMP', true, null, null);
        $this->addColumn('event_location', 'Location', 'LONGVARCHAR', false, null, null);
        $this->addColumn('event_coordinates', 'Coordinates', 'VARCHAR', true, 255, '');
        $this->addColumn('event_calendardata', 'Calendardata', 'VARBINARY', false, null, null);
        $this->addColumn('event_uri', 'Uri', 'VARCHAR', false, 200, null);
        $this->addColumn('event_calendarid', 'EventCalendarid', 'INTEGER', true, 10, null);
        $this->addColumn('event_lastmodified', 'Lastmodified', 'INTEGER', false, null, null);
        $this->addColumn('event_etag', 'Etag', 'VARCHAR', false, 32, null);
        $this->addColumn('event_size', 'Size', 'INTEGER', true, null, null);
        $this->addColumn('event_componenttype', 'Componenttype', 'VARCHAR', false, 8, null);
        $this->addColumn('event_uid', 'Uid', 'VARCHAR', false, 200, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Group', '\\EcclesiaCRM\\Group', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':event_grpid',
    1 => ':grp_ID',
  ),
), null, null, null, false);
        $this->addRelation('EventAttend', '\\EcclesiaCRM\\EventAttend', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':event_id',
    1 => ':event_id',
  ),
), 'CASCADE', null, 'EventAttends', false);
        $this->addRelation('EventCounts', '\\EcclesiaCRM\\EventCounts', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':evtcnt_eventid',
    1 => ':event_id',
  ),
), 'CASCADE', null, 'EventCountss', false);
        $this->addRelation('KioskAssignment', '\\EcclesiaCRM\\KioskAssignment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':kasm_EventId',
    1 => ':event_id',
  ),
), null, null, 'KioskAssignments', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to events_event     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EventAttendTableMap::clearInstancePool();
        EventCountsTableMap::clearInstancePool();
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
        return $withPrefix ? EventTableMap::CLASS_DEFAULT : EventTableMap::OM_CLASS;
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
     * @return array           (Event object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EventTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EventTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EventTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EventTableMap::OM_CLASS;
            /** @var Event $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EventTableMap::addInstanceToPool($obj, $key);
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
            $key = EventTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EventTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Event $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EventTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_ID);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_TYPE);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_TITLE);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_DESC);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_TEXT);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_START);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_END);
            $criteria->addSelectColumn(EventTableMap::COL_INACTIVE);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_TYPENAME);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_GRPID);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_LAST_OCCURENCE);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_LOCATION);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_COORDINATES);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_CALENDARDATA);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_URI);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_CALENDARID);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_LASTMODIFIED);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_ETAG);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_SIZE);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_COMPONENTTYPE);
            $criteria->addSelectColumn(EventTableMap::COL_EVENT_UID);
        } else {
            $criteria->addSelectColumn($alias . '.event_id');
            $criteria->addSelectColumn($alias . '.event_type');
            $criteria->addSelectColumn($alias . '.event_title');
            $criteria->addSelectColumn($alias . '.event_desc');
            $criteria->addSelectColumn($alias . '.event_text');
            $criteria->addSelectColumn($alias . '.event_start');
            $criteria->addSelectColumn($alias . '.event_end');
            $criteria->addSelectColumn($alias . '.inactive');
            $criteria->addSelectColumn($alias . '.event_typename');
            $criteria->addSelectColumn($alias . '.event_grpid');
            $criteria->addSelectColumn($alias . '.event_last_occurence');
            $criteria->addSelectColumn($alias . '.event_location');
            $criteria->addSelectColumn($alias . '.event_coordinates');
            $criteria->addSelectColumn($alias . '.event_calendardata');
            $criteria->addSelectColumn($alias . '.event_uri');
            $criteria->addSelectColumn($alias . '.event_calendarid');
            $criteria->addSelectColumn($alias . '.event_lastmodified');
            $criteria->addSelectColumn($alias . '.event_etag');
            $criteria->addSelectColumn($alias . '.event_size');
            $criteria->addSelectColumn($alias . '.event_componenttype');
            $criteria->addSelectColumn($alias . '.event_uid');
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
        return Propel::getServiceContainer()->getDatabaseMap(EventTableMap::DATABASE_NAME)->getTable(EventTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EventTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EventTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EventTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Event or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Event object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EventTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\Event) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EventTableMap::DATABASE_NAME);
            $criteria->add(EventTableMap::COL_EVENT_ID, (array) $values, Criteria::IN);
        }

        $query = EventQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EventTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EventTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the events_event table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EventQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Event or Criteria object.
     *
     * @param mixed               $criteria Criteria or Event object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Event object
        }

        if ($criteria->containsKey(EventTableMap::COL_EVENT_ID) && $criteria->keyContainsValue(EventTableMap::COL_EVENT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EventTableMap::COL_EVENT_ID.')');
        }


        // Set the correct dbName
        $query = EventQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EventTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EventTableMap::buildTableMap();
