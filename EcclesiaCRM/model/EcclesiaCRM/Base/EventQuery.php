<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Event as ChildEvent;
use EcclesiaCRM\EventQuery as ChildEventQuery;
use EcclesiaCRM\Map\EventTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'events_event' table.
 *
 * This contains events
 *
 * @method     ChildEventQuery orderById($order = Criteria::ASC) Order by the event_id column
 * @method     ChildEventQuery orderByType($order = Criteria::ASC) Order by the event_type column
 * @method     ChildEventQuery orderByTitle($order = Criteria::ASC) Order by the event_title column
 * @method     ChildEventQuery orderByDesc($order = Criteria::ASC) Order by the event_desc column
 * @method     ChildEventQuery orderByText($order = Criteria::ASC) Order by the event_text column
 * @method     ChildEventQuery orderByStart($order = Criteria::ASC) Order by the event_start column
 * @method     ChildEventQuery orderByEnd($order = Criteria::ASC) Order by the event_end column
 * @method     ChildEventQuery orderByInActive($order = Criteria::ASC) Order by the inactive column
 * @method     ChildEventQuery orderByTypeName($order = Criteria::ASC) Order by the event_typename column
 * @method     ChildEventQuery orderByGroupId($order = Criteria::ASC) Order by the event_grpid column
 * @method     ChildEventQuery orderByLastOccurence($order = Criteria::ASC) Order by the event_last_occurence column
 * @method     ChildEventQuery orderByLocation($order = Criteria::ASC) Order by the event_location column
 * @method     ChildEventQuery orderByCoordinates($order = Criteria::ASC) Order by the event_coordinates column
 * @method     ChildEventQuery orderByCalendardata($order = Criteria::ASC) Order by the event_calendardata column
 * @method     ChildEventQuery orderByUri($order = Criteria::ASC) Order by the event_uri column
 * @method     ChildEventQuery orderByEventCalendarid($order = Criteria::ASC) Order by the event_calendarid column
 * @method     ChildEventQuery orderByLastmodified($order = Criteria::ASC) Order by the event_lastmodified column
 * @method     ChildEventQuery orderByEtag($order = Criteria::ASC) Order by the event_etag column
 * @method     ChildEventQuery orderBySize($order = Criteria::ASC) Order by the event_size column
 * @method     ChildEventQuery orderByComponenttype($order = Criteria::ASC) Order by the event_componenttype column
 * @method     ChildEventQuery orderByUid($order = Criteria::ASC) Order by the event_uid column
 *
 * @method     ChildEventQuery groupById() Group by the event_id column
 * @method     ChildEventQuery groupByType() Group by the event_type column
 * @method     ChildEventQuery groupByTitle() Group by the event_title column
 * @method     ChildEventQuery groupByDesc() Group by the event_desc column
 * @method     ChildEventQuery groupByText() Group by the event_text column
 * @method     ChildEventQuery groupByStart() Group by the event_start column
 * @method     ChildEventQuery groupByEnd() Group by the event_end column
 * @method     ChildEventQuery groupByInActive() Group by the inactive column
 * @method     ChildEventQuery groupByTypeName() Group by the event_typename column
 * @method     ChildEventQuery groupByGroupId() Group by the event_grpid column
 * @method     ChildEventQuery groupByLastOccurence() Group by the event_last_occurence column
 * @method     ChildEventQuery groupByLocation() Group by the event_location column
 * @method     ChildEventQuery groupByCoordinates() Group by the event_coordinates column
 * @method     ChildEventQuery groupByCalendardata() Group by the event_calendardata column
 * @method     ChildEventQuery groupByUri() Group by the event_uri column
 * @method     ChildEventQuery groupByEventCalendarid() Group by the event_calendarid column
 * @method     ChildEventQuery groupByLastmodified() Group by the event_lastmodified column
 * @method     ChildEventQuery groupByEtag() Group by the event_etag column
 * @method     ChildEventQuery groupBySize() Group by the event_size column
 * @method     ChildEventQuery groupByComponenttype() Group by the event_componenttype column
 * @method     ChildEventQuery groupByUid() Group by the event_uid column
 *
 * @method     ChildEventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEventQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEventQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEventQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEventQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     ChildEventQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     ChildEventQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     ChildEventQuery joinWithGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Group relation
 *
 * @method     ChildEventQuery leftJoinWithGroup() Adds a LEFT JOIN clause and with to the query using the Group relation
 * @method     ChildEventQuery rightJoinWithGroup() Adds a RIGHT JOIN clause and with to the query using the Group relation
 * @method     ChildEventQuery innerJoinWithGroup() Adds a INNER JOIN clause and with to the query using the Group relation
 *
 * @method     ChildEventQuery leftJoinEventAttend($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventAttend relation
 * @method     ChildEventQuery rightJoinEventAttend($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventAttend relation
 * @method     ChildEventQuery innerJoinEventAttend($relationAlias = null) Adds a INNER JOIN clause to the query using the EventAttend relation
 *
 * @method     ChildEventQuery joinWithEventAttend($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventAttend relation
 *
 * @method     ChildEventQuery leftJoinWithEventAttend() Adds a LEFT JOIN clause and with to the query using the EventAttend relation
 * @method     ChildEventQuery rightJoinWithEventAttend() Adds a RIGHT JOIN clause and with to the query using the EventAttend relation
 * @method     ChildEventQuery innerJoinWithEventAttend() Adds a INNER JOIN clause and with to the query using the EventAttend relation
 *
 * @method     ChildEventQuery leftJoinEventCounts($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventCounts relation
 * @method     ChildEventQuery rightJoinEventCounts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventCounts relation
 * @method     ChildEventQuery innerJoinEventCounts($relationAlias = null) Adds a INNER JOIN clause to the query using the EventCounts relation
 *
 * @method     ChildEventQuery joinWithEventCounts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventCounts relation
 *
 * @method     ChildEventQuery leftJoinWithEventCounts() Adds a LEFT JOIN clause and with to the query using the EventCounts relation
 * @method     ChildEventQuery rightJoinWithEventCounts() Adds a RIGHT JOIN clause and with to the query using the EventCounts relation
 * @method     ChildEventQuery innerJoinWithEventCounts() Adds a INNER JOIN clause and with to the query using the EventCounts relation
 *
 * @method     ChildEventQuery leftJoinKioskAssignment($relationAlias = null) Adds a LEFT JOIN clause to the query using the KioskAssignment relation
 * @method     ChildEventQuery rightJoinKioskAssignment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the KioskAssignment relation
 * @method     ChildEventQuery innerJoinKioskAssignment($relationAlias = null) Adds a INNER JOIN clause to the query using the KioskAssignment relation
 *
 * @method     ChildEventQuery joinWithKioskAssignment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the KioskAssignment relation
 *
 * @method     ChildEventQuery leftJoinWithKioskAssignment() Adds a LEFT JOIN clause and with to the query using the KioskAssignment relation
 * @method     ChildEventQuery rightJoinWithKioskAssignment() Adds a RIGHT JOIN clause and with to the query using the KioskAssignment relation
 * @method     ChildEventQuery innerJoinWithKioskAssignment() Adds a INNER JOIN clause and with to the query using the KioskAssignment relation
 *
 * @method     \EcclesiaCRM\GroupQuery|\EcclesiaCRM\EventAttendQuery|\EcclesiaCRM\EventCountsQuery|\EcclesiaCRM\KioskAssignmentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEvent findOne(ConnectionInterface $con = null) Return the first ChildEvent matching the query
 * @method     ChildEvent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEvent matching the query, or a new ChildEvent object populated from the query conditions when no match is found
 *
 * @method     ChildEvent findOneById(int $event_id) Return the first ChildEvent filtered by the event_id column
 * @method     ChildEvent findOneByType(int $event_type) Return the first ChildEvent filtered by the event_type column
 * @method     ChildEvent findOneByTitle(string $event_title) Return the first ChildEvent filtered by the event_title column
 * @method     ChildEvent findOneByDesc(string $event_desc) Return the first ChildEvent filtered by the event_desc column
 * @method     ChildEvent findOneByText(string $event_text) Return the first ChildEvent filtered by the event_text column
 * @method     ChildEvent findOneByStart(string $event_start) Return the first ChildEvent filtered by the event_start column
 * @method     ChildEvent findOneByEnd(string $event_end) Return the first ChildEvent filtered by the event_end column
 * @method     ChildEvent findOneByInActive(int $inactive) Return the first ChildEvent filtered by the inactive column
 * @method     ChildEvent findOneByTypeName(string $event_typename) Return the first ChildEvent filtered by the event_typename column
 * @method     ChildEvent findOneByGroupId(int $event_grpid) Return the first ChildEvent filtered by the event_grpid column
 * @method     ChildEvent findOneByLastOccurence(string $event_last_occurence) Return the first ChildEvent filtered by the event_last_occurence column
 * @method     ChildEvent findOneByLocation(string $event_location) Return the first ChildEvent filtered by the event_location column
 * @method     ChildEvent findOneByCoordinates(string $event_coordinates) Return the first ChildEvent filtered by the event_coordinates column
 * @method     ChildEvent findOneByCalendardata(string $event_calendardata) Return the first ChildEvent filtered by the event_calendardata column
 * @method     ChildEvent findOneByUri(string $event_uri) Return the first ChildEvent filtered by the event_uri column
 * @method     ChildEvent findOneByEventCalendarid(int $event_calendarid) Return the first ChildEvent filtered by the event_calendarid column
 * @method     ChildEvent findOneByLastmodified(int $event_lastmodified) Return the first ChildEvent filtered by the event_lastmodified column
 * @method     ChildEvent findOneByEtag(string $event_etag) Return the first ChildEvent filtered by the event_etag column
 * @method     ChildEvent findOneBySize(int $event_size) Return the first ChildEvent filtered by the event_size column
 * @method     ChildEvent findOneByComponenttype(string $event_componenttype) Return the first ChildEvent filtered by the event_componenttype column
 * @method     ChildEvent findOneByUid(string $event_uid) Return the first ChildEvent filtered by the event_uid column *

 * @method     ChildEvent requirePk($key, ConnectionInterface $con = null) Return the ChildEvent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOne(ConnectionInterface $con = null) Return the first ChildEvent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEvent requireOneById(int $event_id) Return the first ChildEvent filtered by the event_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByType(int $event_type) Return the first ChildEvent filtered by the event_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByTitle(string $event_title) Return the first ChildEvent filtered by the event_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByDesc(string $event_desc) Return the first ChildEvent filtered by the event_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByText(string $event_text) Return the first ChildEvent filtered by the event_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByStart(string $event_start) Return the first ChildEvent filtered by the event_start column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByEnd(string $event_end) Return the first ChildEvent filtered by the event_end column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByInActive(int $inactive) Return the first ChildEvent filtered by the inactive column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByTypeName(string $event_typename) Return the first ChildEvent filtered by the event_typename column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByGroupId(int $event_grpid) Return the first ChildEvent filtered by the event_grpid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByLastOccurence(string $event_last_occurence) Return the first ChildEvent filtered by the event_last_occurence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByLocation(string $event_location) Return the first ChildEvent filtered by the event_location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByCoordinates(string $event_coordinates) Return the first ChildEvent filtered by the event_coordinates column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByCalendardata(string $event_calendardata) Return the first ChildEvent filtered by the event_calendardata column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByUri(string $event_uri) Return the first ChildEvent filtered by the event_uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByEventCalendarid(int $event_calendarid) Return the first ChildEvent filtered by the event_calendarid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByLastmodified(int $event_lastmodified) Return the first ChildEvent filtered by the event_lastmodified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByEtag(string $event_etag) Return the first ChildEvent filtered by the event_etag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneBySize(int $event_size) Return the first ChildEvent filtered by the event_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByComponenttype(string $event_componenttype) Return the first ChildEvent filtered by the event_componenttype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByUid(string $event_uid) Return the first ChildEvent filtered by the event_uid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEvent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEvent objects based on current ModelCriteria
 * @method     ChildEvent[]|ObjectCollection findById(int $event_id) Return ChildEvent objects filtered by the event_id column
 * @method     ChildEvent[]|ObjectCollection findByType(int $event_type) Return ChildEvent objects filtered by the event_type column
 * @method     ChildEvent[]|ObjectCollection findByTitle(string $event_title) Return ChildEvent objects filtered by the event_title column
 * @method     ChildEvent[]|ObjectCollection findByDesc(string $event_desc) Return ChildEvent objects filtered by the event_desc column
 * @method     ChildEvent[]|ObjectCollection findByText(string $event_text) Return ChildEvent objects filtered by the event_text column
 * @method     ChildEvent[]|ObjectCollection findByStart(string $event_start) Return ChildEvent objects filtered by the event_start column
 * @method     ChildEvent[]|ObjectCollection findByEnd(string $event_end) Return ChildEvent objects filtered by the event_end column
 * @method     ChildEvent[]|ObjectCollection findByInActive(int $inactive) Return ChildEvent objects filtered by the inactive column
 * @method     ChildEvent[]|ObjectCollection findByTypeName(string $event_typename) Return ChildEvent objects filtered by the event_typename column
 * @method     ChildEvent[]|ObjectCollection findByGroupId(int $event_grpid) Return ChildEvent objects filtered by the event_grpid column
 * @method     ChildEvent[]|ObjectCollection findByLastOccurence(string $event_last_occurence) Return ChildEvent objects filtered by the event_last_occurence column
 * @method     ChildEvent[]|ObjectCollection findByLocation(string $event_location) Return ChildEvent objects filtered by the event_location column
 * @method     ChildEvent[]|ObjectCollection findByCoordinates(string $event_coordinates) Return ChildEvent objects filtered by the event_coordinates column
 * @method     ChildEvent[]|ObjectCollection findByCalendardata(string $event_calendardata) Return ChildEvent objects filtered by the event_calendardata column
 * @method     ChildEvent[]|ObjectCollection findByUri(string $event_uri) Return ChildEvent objects filtered by the event_uri column
 * @method     ChildEvent[]|ObjectCollection findByEventCalendarid(int $event_calendarid) Return ChildEvent objects filtered by the event_calendarid column
 * @method     ChildEvent[]|ObjectCollection findByLastmodified(int $event_lastmodified) Return ChildEvent objects filtered by the event_lastmodified column
 * @method     ChildEvent[]|ObjectCollection findByEtag(string $event_etag) Return ChildEvent objects filtered by the event_etag column
 * @method     ChildEvent[]|ObjectCollection findBySize(int $event_size) Return ChildEvent objects filtered by the event_size column
 * @method     ChildEvent[]|ObjectCollection findByComponenttype(string $event_componenttype) Return ChildEvent objects filtered by the event_componenttype column
 * @method     ChildEvent[]|ObjectCollection findByUid(string $event_uid) Return ChildEvent objects filtered by the event_uid column
 * @method     ChildEvent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EventQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\EventQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Event', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEventQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEventQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEventQuery) {
            return $criteria;
        }
        $query = new ChildEventQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildEvent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EventTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EventTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEvent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT event_id, event_type, event_title, event_desc, event_text, event_start, event_end, inactive, event_typename, event_grpid, event_last_occurence, event_location, event_coordinates, event_calendardata, event_uri, event_calendarid, event_lastmodified, event_etag, event_size, event_componenttype, event_uid FROM events_event WHERE event_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildEvent $obj */
            $obj = new ChildEvent();
            $obj->hydrate($row);
            EventTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildEvent|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the event_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE event_id = 1234
     * $query->filterById(array(12, 34)); // WHERE event_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE event_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $id, $comparison);
    }

    /**
     * Filter the query on the event_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType(1234); // WHERE event_type = 1234
     * $query->filterByType(array(12, 34)); // WHERE event_type IN (12, 34)
     * $query->filterByType(array('min' => 12)); // WHERE event_type > 12
     * </code>
     *
     * @param     mixed $type The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_array($type)) {
            $useMinMax = false;
            if (isset($type['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_TYPE, $type['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($type['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_TYPE, $type['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the event_title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE event_title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE event_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the event_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByDesc('fooValue');   // WHERE event_desc = 'fooValue'
     * $query->filterByDesc('%fooValue%', Criteria::LIKE); // WHERE event_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $desc The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByDesc($desc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($desc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_DESC, $desc, $comparison);
    }

    /**
     * Filter the query on the event_text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE event_text = 'fooValue'
     * $query->filterByText('%fooValue%', Criteria::LIKE); // WHERE event_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the event_start column
     *
     * Example usage:
     * <code>
     * $query->filterByStart('2011-03-14'); // WHERE event_start = '2011-03-14'
     * $query->filterByStart('now'); // WHERE event_start = '2011-03-14'
     * $query->filterByStart(array('max' => 'yesterday')); // WHERE event_start > '2011-03-13'
     * </code>
     *
     * @param     mixed $start The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByStart($start = null, $comparison = null)
    {
        if (is_array($start)) {
            $useMinMax = false;
            if (isset($start['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_START, $start['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($start['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_START, $start['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_START, $start, $comparison);
    }

    /**
     * Filter the query on the event_end column
     *
     * Example usage:
     * <code>
     * $query->filterByEnd('2011-03-14'); // WHERE event_end = '2011-03-14'
     * $query->filterByEnd('now'); // WHERE event_end = '2011-03-14'
     * $query->filterByEnd(array('max' => 'yesterday')); // WHERE event_end > '2011-03-13'
     * </code>
     *
     * @param     mixed $end The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByEnd($end = null, $comparison = null)
    {
        if (is_array($end)) {
            $useMinMax = false;
            if (isset($end['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_END, $end['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($end['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_END, $end['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_END, $end, $comparison);
    }

    /**
     * Filter the query on the inactive column
     *
     * Example usage:
     * <code>
     * $query->filterByInActive(1234); // WHERE inactive = 1234
     * $query->filterByInActive(array(12, 34)); // WHERE inactive IN (12, 34)
     * $query->filterByInActive(array('min' => 12)); // WHERE inactive > 12
     * </code>
     *
     * @param     mixed $inActive The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByInActive($inActive = null, $comparison = null)
    {
        if (is_array($inActive)) {
            $useMinMax = false;
            if (isset($inActive['min'])) {
                $this->addUsingAlias(EventTableMap::COL_INACTIVE, $inActive['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($inActive['max'])) {
                $this->addUsingAlias(EventTableMap::COL_INACTIVE, $inActive['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_INACTIVE, $inActive, $comparison);
    }

    /**
     * Filter the query on the event_typename column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeName('fooValue');   // WHERE event_typename = 'fooValue'
     * $query->filterByTypeName('%fooValue%', Criteria::LIKE); // WHERE event_typename LIKE '%fooValue%'
     * </code>
     *
     * @param     string $typeName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByTypeName($typeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($typeName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_TYPENAME, $typeName, $comparison);
    }

    /**
     * Filter the query on the event_grpid column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupId(1234); // WHERE event_grpid = 1234
     * $query->filterByGroupId(array(12, 34)); // WHERE event_grpid IN (12, 34)
     * $query->filterByGroupId(array('min' => 12)); // WHERE event_grpid > 12
     * </code>
     *
     * @see       filterByGroup()
     *
     * @param     mixed $groupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByGroupId($groupId = null, $comparison = null)
    {
        if (is_array($groupId)) {
            $useMinMax = false;
            if (isset($groupId['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_GRPID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_GRPID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_GRPID, $groupId, $comparison);
    }

    /**
     * Filter the query on the event_last_occurence column
     *
     * Example usage:
     * <code>
     * $query->filterByLastOccurence('2011-03-14'); // WHERE event_last_occurence = '2011-03-14'
     * $query->filterByLastOccurence('now'); // WHERE event_last_occurence = '2011-03-14'
     * $query->filterByLastOccurence(array('max' => 'yesterday')); // WHERE event_last_occurence > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastOccurence The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByLastOccurence($lastOccurence = null, $comparison = null)
    {
        if (is_array($lastOccurence)) {
            $useMinMax = false;
            if (isset($lastOccurence['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_LAST_OCCURENCE, $lastOccurence['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastOccurence['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_LAST_OCCURENCE, $lastOccurence['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_LAST_OCCURENCE, $lastOccurence, $comparison);
    }

    /**
     * Filter the query on the event_location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE event_location = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE event_location LIKE '%fooValue%'
     * </code>
     *
     * @param     string $location The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByLocation($location = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_LOCATION, $location, $comparison);
    }

    /**
     * Filter the query on the event_coordinates column
     *
     * Example usage:
     * <code>
     * $query->filterByCoordinates('fooValue');   // WHERE event_coordinates = 'fooValue'
     * $query->filterByCoordinates('%fooValue%', Criteria::LIKE); // WHERE event_coordinates LIKE '%fooValue%'
     * </code>
     *
     * @param     string $coordinates The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByCoordinates($coordinates = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coordinates)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_COORDINATES, $coordinates, $comparison);
    }

    /**
     * Filter the query on the event_calendardata column
     *
     * @param     mixed $calendardata The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByCalendardata($calendardata = null, $comparison = null)
    {

        return $this->addUsingAlias(EventTableMap::COL_EVENT_CALENDARDATA, $calendardata, $comparison);
    }

    /**
     * Filter the query on the event_uri column
     *
     * Example usage:
     * <code>
     * $query->filterByUri('fooValue');   // WHERE event_uri = 'fooValue'
     * $query->filterByUri('%fooValue%', Criteria::LIKE); // WHERE event_uri LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uri The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_URI, $uri, $comparison);
    }

    /**
     * Filter the query on the event_calendarid column
     *
     * Example usage:
     * <code>
     * $query->filterByEventCalendarid(1234); // WHERE event_calendarid = 1234
     * $query->filterByEventCalendarid(array(12, 34)); // WHERE event_calendarid IN (12, 34)
     * $query->filterByEventCalendarid(array('min' => 12)); // WHERE event_calendarid > 12
     * </code>
     *
     * @param     mixed $eventCalendarid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByEventCalendarid($eventCalendarid = null, $comparison = null)
    {
        if (is_array($eventCalendarid)) {
            $useMinMax = false;
            if (isset($eventCalendarid['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_CALENDARID, $eventCalendarid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventCalendarid['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_CALENDARID, $eventCalendarid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_CALENDARID, $eventCalendarid, $comparison);
    }

    /**
     * Filter the query on the event_lastmodified column
     *
     * Example usage:
     * <code>
     * $query->filterByLastmodified(1234); // WHERE event_lastmodified = 1234
     * $query->filterByLastmodified(array(12, 34)); // WHERE event_lastmodified IN (12, 34)
     * $query->filterByLastmodified(array('min' => 12)); // WHERE event_lastmodified > 12
     * </code>
     *
     * @param     mixed $lastmodified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByLastmodified($lastmodified = null, $comparison = null)
    {
        if (is_array($lastmodified)) {
            $useMinMax = false;
            if (isset($lastmodified['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_LASTMODIFIED, $lastmodified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastmodified['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_LASTMODIFIED, $lastmodified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_LASTMODIFIED, $lastmodified, $comparison);
    }

    /**
     * Filter the query on the event_etag column
     *
     * Example usage:
     * <code>
     * $query->filterByEtag('fooValue');   // WHERE event_etag = 'fooValue'
     * $query->filterByEtag('%fooValue%', Criteria::LIKE); // WHERE event_etag LIKE '%fooValue%'
     * </code>
     *
     * @param     string $etag The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByEtag($etag = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($etag)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_ETAG, $etag, $comparison);
    }

    /**
     * Filter the query on the event_size column
     *
     * Example usage:
     * <code>
     * $query->filterBySize(1234); // WHERE event_size = 1234
     * $query->filterBySize(array(12, 34)); // WHERE event_size IN (12, 34)
     * $query->filterBySize(array('min' => 12)); // WHERE event_size > 12
     * </code>
     *
     * @param     mixed $size The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterBySize($size = null, $comparison = null)
    {
        if (is_array($size)) {
            $useMinMax = false;
            if (isset($size['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_SIZE, $size['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($size['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_SIZE, $size['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_SIZE, $size, $comparison);
    }

    /**
     * Filter the query on the event_componenttype column
     *
     * Example usage:
     * <code>
     * $query->filterByComponenttype('fooValue');   // WHERE event_componenttype = 'fooValue'
     * $query->filterByComponenttype('%fooValue%', Criteria::LIKE); // WHERE event_componenttype LIKE '%fooValue%'
     * </code>
     *
     * @param     string $componenttype The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByComponenttype($componenttype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($componenttype)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_COMPONENTTYPE, $componenttype, $comparison);
    }

    /**
     * Filter the query on the event_uid column
     *
     * Example usage:
     * <code>
     * $query->filterByUid('fooValue');   // WHERE event_uid = 'fooValue'
     * $query->filterByUid('%fooValue%', Criteria::LIKE); // WHERE event_uid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByUid($uid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_UID, $uid, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Group object
     *
     * @param \EcclesiaCRM\Group|ObjectCollection $group The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof \EcclesiaCRM\Group) {
            return $this
                ->addUsingAlias(EventTableMap::COL_EVENT_GRPID, $group->getId(), $comparison);
        } elseif ($group instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventTableMap::COL_EVENT_GRPID, $group->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGroup() only accepts arguments of type \EcclesiaCRM\Group or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Group relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinGroup($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Group');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Group');
        }

        return $this;
    }

    /**
     * Use the Group relation Group object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\GroupQuery A secondary query class using the current class as primary query
     */
    public function useGroupQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Group', '\EcclesiaCRM\GroupQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\EventAttend object
     *
     * @param \EcclesiaCRM\EventAttend|ObjectCollection $eventAttend the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByEventAttend($eventAttend, $comparison = null)
    {
        if ($eventAttend instanceof \EcclesiaCRM\EventAttend) {
            return $this
                ->addUsingAlias(EventTableMap::COL_EVENT_ID, $eventAttend->getEventId(), $comparison);
        } elseif ($eventAttend instanceof ObjectCollection) {
            return $this
                ->useEventAttendQuery()
                ->filterByPrimaryKeys($eventAttend->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEventAttend() only accepts arguments of type \EcclesiaCRM\EventAttend or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventAttend relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinEventAttend($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventAttend');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EventAttend');
        }

        return $this;
    }

    /**
     * Use the EventAttend relation EventAttend object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\EventAttendQuery A secondary query class using the current class as primary query
     */
    public function useEventAttendQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEventAttend($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventAttend', '\EcclesiaCRM\EventAttendQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\EventCounts object
     *
     * @param \EcclesiaCRM\EventCounts|ObjectCollection $eventCounts the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByEventCounts($eventCounts, $comparison = null)
    {
        if ($eventCounts instanceof \EcclesiaCRM\EventCounts) {
            return $this
                ->addUsingAlias(EventTableMap::COL_EVENT_ID, $eventCounts->getEvtcntEventid(), $comparison);
        } elseif ($eventCounts instanceof ObjectCollection) {
            return $this
                ->useEventCountsQuery()
                ->filterByPrimaryKeys($eventCounts->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEventCounts() only accepts arguments of type \EcclesiaCRM\EventCounts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventCounts relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinEventCounts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventCounts');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EventCounts');
        }

        return $this;
    }

    /**
     * Use the EventCounts relation EventCounts object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\EventCountsQuery A secondary query class using the current class as primary query
     */
    public function useEventCountsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEventCounts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventCounts', '\EcclesiaCRM\EventCountsQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\KioskAssignment object
     *
     * @param \EcclesiaCRM\KioskAssignment|ObjectCollection $kioskAssignment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByKioskAssignment($kioskAssignment, $comparison = null)
    {
        if ($kioskAssignment instanceof \EcclesiaCRM\KioskAssignment) {
            return $this
                ->addUsingAlias(EventTableMap::COL_EVENT_ID, $kioskAssignment->getEventId(), $comparison);
        } elseif ($kioskAssignment instanceof ObjectCollection) {
            return $this
                ->useKioskAssignmentQuery()
                ->filterByPrimaryKeys($kioskAssignment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByKioskAssignment() only accepts arguments of type \EcclesiaCRM\KioskAssignment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the KioskAssignment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinKioskAssignment($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('KioskAssignment');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'KioskAssignment');
        }

        return $this;
    }

    /**
     * Use the KioskAssignment relation KioskAssignment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\KioskAssignmentQuery A secondary query class using the current class as primary query
     */
    public function useKioskAssignmentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinKioskAssignment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'KioskAssignment', '\EcclesiaCRM\KioskAssignmentQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEvent $event Object to remove from the list of results
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function prune($event = null)
    {
        if ($event) {
            $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $event->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the events_event table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EventTableMap::clearInstancePool();
            EventTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EventTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EventTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EventTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EventQuery
