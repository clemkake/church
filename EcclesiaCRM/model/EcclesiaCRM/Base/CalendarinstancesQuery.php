<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Calendarinstances as ChildCalendarinstances;
use EcclesiaCRM\CalendarinstancesQuery as ChildCalendarinstancesQuery;
use EcclesiaCRM\Map\CalendarinstancesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'calendarinstances' table.
 *
 * Calendar management
 *
 * @method     ChildCalendarinstancesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCalendarinstancesQuery orderByCalendarid($order = Criteria::ASC) Order by the calendarid column
 * @method     ChildCalendarinstancesQuery orderByPrincipaluri($order = Criteria::ASC) Order by the principaluri column
 * @method     ChildCalendarinstancesQuery orderByAccess($order = Criteria::ASC) Order by the access column
 * @method     ChildCalendarinstancesQuery orderByDisplayname($order = Criteria::ASC) Order by the displayname column
 * @method     ChildCalendarinstancesQuery orderByUri($order = Criteria::ASC) Order by the uri column
 * @method     ChildCalendarinstancesQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildCalendarinstancesQuery orderByCalendarorder($order = Criteria::ASC) Order by the calendarorder column
 * @method     ChildCalendarinstancesQuery orderByCalendarcolor($order = Criteria::ASC) Order by the calendarcolor column
 * @method     ChildCalendarinstancesQuery orderByVisible($order = Criteria::ASC) Order by the visible column
 * @method     ChildCalendarinstancesQuery orderByPresent($order = Criteria::ASC) Order by the present column
 * @method     ChildCalendarinstancesQuery orderByTimezone($order = Criteria::ASC) Order by the timezone column
 * @method     ChildCalendarinstancesQuery orderByTransparent($order = Criteria::ASC) Order by the transparent column
 * @method     ChildCalendarinstancesQuery orderByShareHref($order = Criteria::ASC) Order by the share_href column
 * @method     ChildCalendarinstancesQuery orderByShareDisplayname($order = Criteria::ASC) Order by the share_displayname column
 * @method     ChildCalendarinstancesQuery orderByShareInvitestatus($order = Criteria::ASC) Order by the share_invitestatus column
 * @method     ChildCalendarinstancesQuery orderByGroupId($order = Criteria::ASC) Order by the grpid column
 * @method     ChildCalendarinstancesQuery orderByType($order = Criteria::ASC) Order by the cal_type column
 *
 * @method     ChildCalendarinstancesQuery groupById() Group by the id column
 * @method     ChildCalendarinstancesQuery groupByCalendarid() Group by the calendarid column
 * @method     ChildCalendarinstancesQuery groupByPrincipaluri() Group by the principaluri column
 * @method     ChildCalendarinstancesQuery groupByAccess() Group by the access column
 * @method     ChildCalendarinstancesQuery groupByDisplayname() Group by the displayname column
 * @method     ChildCalendarinstancesQuery groupByUri() Group by the uri column
 * @method     ChildCalendarinstancesQuery groupByDescription() Group by the description column
 * @method     ChildCalendarinstancesQuery groupByCalendarorder() Group by the calendarorder column
 * @method     ChildCalendarinstancesQuery groupByCalendarcolor() Group by the calendarcolor column
 * @method     ChildCalendarinstancesQuery groupByVisible() Group by the visible column
 * @method     ChildCalendarinstancesQuery groupByPresent() Group by the present column
 * @method     ChildCalendarinstancesQuery groupByTimezone() Group by the timezone column
 * @method     ChildCalendarinstancesQuery groupByTransparent() Group by the transparent column
 * @method     ChildCalendarinstancesQuery groupByShareHref() Group by the share_href column
 * @method     ChildCalendarinstancesQuery groupByShareDisplayname() Group by the share_displayname column
 * @method     ChildCalendarinstancesQuery groupByShareInvitestatus() Group by the share_invitestatus column
 * @method     ChildCalendarinstancesQuery groupByGroupId() Group by the grpid column
 * @method     ChildCalendarinstancesQuery groupByType() Group by the cal_type column
 *
 * @method     ChildCalendarinstancesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCalendarinstancesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCalendarinstancesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCalendarinstancesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCalendarinstancesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCalendarinstancesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCalendarinstances findOne(ConnectionInterface $con = null) Return the first ChildCalendarinstances matching the query
 * @method     ChildCalendarinstances findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCalendarinstances matching the query, or a new ChildCalendarinstances object populated from the query conditions when no match is found
 *
 * @method     ChildCalendarinstances findOneById(int $id) Return the first ChildCalendarinstances filtered by the id column
 * @method     ChildCalendarinstances findOneByCalendarid(int $calendarid) Return the first ChildCalendarinstances filtered by the calendarid column
 * @method     ChildCalendarinstances findOneByPrincipaluri(string $principaluri) Return the first ChildCalendarinstances filtered by the principaluri column
 * @method     ChildCalendarinstances findOneByAccess(boolean $access) Return the first ChildCalendarinstances filtered by the access column
 * @method     ChildCalendarinstances findOneByDisplayname(string $displayname) Return the first ChildCalendarinstances filtered by the displayname column
 * @method     ChildCalendarinstances findOneByUri(string $uri) Return the first ChildCalendarinstances filtered by the uri column
 * @method     ChildCalendarinstances findOneByDescription(string $description) Return the first ChildCalendarinstances filtered by the description column
 * @method     ChildCalendarinstances findOneByCalendarorder(int $calendarorder) Return the first ChildCalendarinstances filtered by the calendarorder column
 * @method     ChildCalendarinstances findOneByCalendarcolor(string $calendarcolor) Return the first ChildCalendarinstances filtered by the calendarcolor column
 * @method     ChildCalendarinstances findOneByVisible(boolean $visible) Return the first ChildCalendarinstances filtered by the visible column
 * @method     ChildCalendarinstances findOneByPresent(boolean $present) Return the first ChildCalendarinstances filtered by the present column
 * @method     ChildCalendarinstances findOneByTimezone(string $timezone) Return the first ChildCalendarinstances filtered by the timezone column
 * @method     ChildCalendarinstances findOneByTransparent(boolean $transparent) Return the first ChildCalendarinstances filtered by the transparent column
 * @method     ChildCalendarinstances findOneByShareHref(string $share_href) Return the first ChildCalendarinstances filtered by the share_href column
 * @method     ChildCalendarinstances findOneByShareDisplayname(string $share_displayname) Return the first ChildCalendarinstances filtered by the share_displayname column
 * @method     ChildCalendarinstances findOneByShareInvitestatus(boolean $share_invitestatus) Return the first ChildCalendarinstances filtered by the share_invitestatus column
 * @method     ChildCalendarinstances findOneByGroupId(int $grpid) Return the first ChildCalendarinstances filtered by the grpid column
 * @method     ChildCalendarinstances findOneByType(int $cal_type) Return the first ChildCalendarinstances filtered by the cal_type column *

 * @method     ChildCalendarinstances requirePk($key, ConnectionInterface $con = null) Return the ChildCalendarinstances by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOne(ConnectionInterface $con = null) Return the first ChildCalendarinstances matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCalendarinstances requireOneById(int $id) Return the first ChildCalendarinstances filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByCalendarid(int $calendarid) Return the first ChildCalendarinstances filtered by the calendarid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByPrincipaluri(string $principaluri) Return the first ChildCalendarinstances filtered by the principaluri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByAccess(boolean $access) Return the first ChildCalendarinstances filtered by the access column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByDisplayname(string $displayname) Return the first ChildCalendarinstances filtered by the displayname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByUri(string $uri) Return the first ChildCalendarinstances filtered by the uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByDescription(string $description) Return the first ChildCalendarinstances filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByCalendarorder(int $calendarorder) Return the first ChildCalendarinstances filtered by the calendarorder column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByCalendarcolor(string $calendarcolor) Return the first ChildCalendarinstances filtered by the calendarcolor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByVisible(boolean $visible) Return the first ChildCalendarinstances filtered by the visible column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByPresent(boolean $present) Return the first ChildCalendarinstances filtered by the present column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByTimezone(string $timezone) Return the first ChildCalendarinstances filtered by the timezone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByTransparent(boolean $transparent) Return the first ChildCalendarinstances filtered by the transparent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByShareHref(string $share_href) Return the first ChildCalendarinstances filtered by the share_href column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByShareDisplayname(string $share_displayname) Return the first ChildCalendarinstances filtered by the share_displayname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByShareInvitestatus(boolean $share_invitestatus) Return the first ChildCalendarinstances filtered by the share_invitestatus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByGroupId(int $grpid) Return the first ChildCalendarinstances filtered by the grpid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarinstances requireOneByType(int $cal_type) Return the first ChildCalendarinstances filtered by the cal_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCalendarinstances[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCalendarinstances objects based on current ModelCriteria
 * @method     ChildCalendarinstances[]|ObjectCollection findById(int $id) Return ChildCalendarinstances objects filtered by the id column
 * @method     ChildCalendarinstances[]|ObjectCollection findByCalendarid(int $calendarid) Return ChildCalendarinstances objects filtered by the calendarid column
 * @method     ChildCalendarinstances[]|ObjectCollection findByPrincipaluri(string $principaluri) Return ChildCalendarinstances objects filtered by the principaluri column
 * @method     ChildCalendarinstances[]|ObjectCollection findByAccess(boolean $access) Return ChildCalendarinstances objects filtered by the access column
 * @method     ChildCalendarinstances[]|ObjectCollection findByDisplayname(string $displayname) Return ChildCalendarinstances objects filtered by the displayname column
 * @method     ChildCalendarinstances[]|ObjectCollection findByUri(string $uri) Return ChildCalendarinstances objects filtered by the uri column
 * @method     ChildCalendarinstances[]|ObjectCollection findByDescription(string $description) Return ChildCalendarinstances objects filtered by the description column
 * @method     ChildCalendarinstances[]|ObjectCollection findByCalendarorder(int $calendarorder) Return ChildCalendarinstances objects filtered by the calendarorder column
 * @method     ChildCalendarinstances[]|ObjectCollection findByCalendarcolor(string $calendarcolor) Return ChildCalendarinstances objects filtered by the calendarcolor column
 * @method     ChildCalendarinstances[]|ObjectCollection findByVisible(boolean $visible) Return ChildCalendarinstances objects filtered by the visible column
 * @method     ChildCalendarinstances[]|ObjectCollection findByPresent(boolean $present) Return ChildCalendarinstances objects filtered by the present column
 * @method     ChildCalendarinstances[]|ObjectCollection findByTimezone(string $timezone) Return ChildCalendarinstances objects filtered by the timezone column
 * @method     ChildCalendarinstances[]|ObjectCollection findByTransparent(boolean $transparent) Return ChildCalendarinstances objects filtered by the transparent column
 * @method     ChildCalendarinstances[]|ObjectCollection findByShareHref(string $share_href) Return ChildCalendarinstances objects filtered by the share_href column
 * @method     ChildCalendarinstances[]|ObjectCollection findByShareDisplayname(string $share_displayname) Return ChildCalendarinstances objects filtered by the share_displayname column
 * @method     ChildCalendarinstances[]|ObjectCollection findByShareInvitestatus(boolean $share_invitestatus) Return ChildCalendarinstances objects filtered by the share_invitestatus column
 * @method     ChildCalendarinstances[]|ObjectCollection findByGroupId(int $grpid) Return ChildCalendarinstances objects filtered by the grpid column
 * @method     ChildCalendarinstances[]|ObjectCollection findByType(int $cal_type) Return ChildCalendarinstances objects filtered by the cal_type column
 * @method     ChildCalendarinstances[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CalendarinstancesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\CalendarinstancesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Calendarinstances', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCalendarinstancesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCalendarinstancesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCalendarinstancesQuery) {
            return $criteria;
        }
        $query = new ChildCalendarinstancesQuery();
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
     * @return ChildCalendarinstances|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CalendarinstancesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CalendarinstancesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCalendarinstances A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, calendarid, principaluri, access, displayname, uri, description, calendarorder, calendarcolor, visible, present, timezone, transparent, share_href, share_displayname, share_invitestatus, grpid, cal_type FROM calendarinstances WHERE id = :p0';
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
            /** @var ChildCalendarinstances $obj */
            $obj = new ChildCalendarinstances();
            $obj->hydrate($row);
            CalendarinstancesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCalendarinstances|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the calendarid column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarid(1234); // WHERE calendarid = 1234
     * $query->filterByCalendarid(array(12, 34)); // WHERE calendarid IN (12, 34)
     * $query->filterByCalendarid(array('min' => 12)); // WHERE calendarid > 12
     * </code>
     *
     * @param     mixed $calendarid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByCalendarid($calendarid = null, $comparison = null)
    {
        if (is_array($calendarid)) {
            $useMinMax = false;
            if (isset($calendarid['min'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_CALENDARID, $calendarid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calendarid['max'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_CALENDARID, $calendarid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_CALENDARID, $calendarid, $comparison);
    }

    /**
     * Filter the query on the principaluri column
     *
     * Example usage:
     * <code>
     * $query->filterByPrincipaluri('fooValue');   // WHERE principaluri = 'fooValue'
     * $query->filterByPrincipaluri('%fooValue%', Criteria::LIKE); // WHERE principaluri LIKE '%fooValue%'
     * </code>
     *
     * @param     string $principaluri The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByPrincipaluri($principaluri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($principaluri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_PRINCIPALURI, $principaluri, $comparison);
    }

    /**
     * Filter the query on the access column
     *
     * Example usage:
     * <code>
     * $query->filterByAccess(true); // WHERE access = true
     * $query->filterByAccess('yes'); // WHERE access = true
     * </code>
     *
     * @param     boolean|string $access The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByAccess($access = null, $comparison = null)
    {
        if (is_string($access)) {
            $access = in_array(strtolower($access), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_ACCESS, $access, $comparison);
    }

    /**
     * Filter the query on the displayname column
     *
     * Example usage:
     * <code>
     * $query->filterByDisplayname('fooValue');   // WHERE displayname = 'fooValue'
     * $query->filterByDisplayname('%fooValue%', Criteria::LIKE); // WHERE displayname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $displayname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByDisplayname($displayname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($displayname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_DISPLAYNAME, $displayname, $comparison);
    }

    /**
     * Filter the query on the uri column
     *
     * Example usage:
     * <code>
     * $query->filterByUri('fooValue');   // WHERE uri = 'fooValue'
     * $query->filterByUri('%fooValue%', Criteria::LIKE); // WHERE uri LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uri The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_URI, $uri, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the calendarorder column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarorder(1234); // WHERE calendarorder = 1234
     * $query->filterByCalendarorder(array(12, 34)); // WHERE calendarorder IN (12, 34)
     * $query->filterByCalendarorder(array('min' => 12)); // WHERE calendarorder > 12
     * </code>
     *
     * @param     mixed $calendarorder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByCalendarorder($calendarorder = null, $comparison = null)
    {
        if (is_array($calendarorder)) {
            $useMinMax = false;
            if (isset($calendarorder['min'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_CALENDARORDER, $calendarorder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calendarorder['max'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_CALENDARORDER, $calendarorder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_CALENDARORDER, $calendarorder, $comparison);
    }

    /**
     * Filter the query on the calendarcolor column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarcolor('fooValue');   // WHERE calendarcolor = 'fooValue'
     * $query->filterByCalendarcolor('%fooValue%', Criteria::LIKE); // WHERE calendarcolor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $calendarcolor The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByCalendarcolor($calendarcolor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calendarcolor)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_CALENDARCOLOR, $calendarcolor, $comparison);
    }

    /**
     * Filter the query on the visible column
     *
     * Example usage:
     * <code>
     * $query->filterByVisible(true); // WHERE visible = true
     * $query->filterByVisible('yes'); // WHERE visible = true
     * </code>
     *
     * @param     boolean|string $visible The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByVisible($visible = null, $comparison = null)
    {
        if (is_string($visible)) {
            $visible = in_array(strtolower($visible), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_VISIBLE, $visible, $comparison);
    }

    /**
     * Filter the query on the present column
     *
     * Example usage:
     * <code>
     * $query->filterByPresent(true); // WHERE present = true
     * $query->filterByPresent('yes'); // WHERE present = true
     * </code>
     *
     * @param     boolean|string $present The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByPresent($present = null, $comparison = null)
    {
        if (is_string($present)) {
            $present = in_array(strtolower($present), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_PRESENT, $present, $comparison);
    }

    /**
     * Filter the query on the timezone column
     *
     * Example usage:
     * <code>
     * $query->filterByTimezone('fooValue');   // WHERE timezone = 'fooValue'
     * $query->filterByTimezone('%fooValue%', Criteria::LIKE); // WHERE timezone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $timezone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByTimezone($timezone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($timezone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_TIMEZONE, $timezone, $comparison);
    }

    /**
     * Filter the query on the transparent column
     *
     * Example usage:
     * <code>
     * $query->filterByTransparent(true); // WHERE transparent = true
     * $query->filterByTransparent('yes'); // WHERE transparent = true
     * </code>
     *
     * @param     boolean|string $transparent The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByTransparent($transparent = null, $comparison = null)
    {
        if (is_string($transparent)) {
            $transparent = in_array(strtolower($transparent), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_TRANSPARENT, $transparent, $comparison);
    }

    /**
     * Filter the query on the share_href column
     *
     * Example usage:
     * <code>
     * $query->filterByShareHref('fooValue');   // WHERE share_href = 'fooValue'
     * $query->filterByShareHref('%fooValue%', Criteria::LIKE); // WHERE share_href LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shareHref The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByShareHref($shareHref = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shareHref)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_SHARE_HREF, $shareHref, $comparison);
    }

    /**
     * Filter the query on the share_displayname column
     *
     * Example usage:
     * <code>
     * $query->filterByShareDisplayname('fooValue');   // WHERE share_displayname = 'fooValue'
     * $query->filterByShareDisplayname('%fooValue%', Criteria::LIKE); // WHERE share_displayname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shareDisplayname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByShareDisplayname($shareDisplayname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shareDisplayname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_SHARE_DISPLAYNAME, $shareDisplayname, $comparison);
    }

    /**
     * Filter the query on the share_invitestatus column
     *
     * Example usage:
     * <code>
     * $query->filterByShareInvitestatus(true); // WHERE share_invitestatus = true
     * $query->filterByShareInvitestatus('yes'); // WHERE share_invitestatus = true
     * </code>
     *
     * @param     boolean|string $shareInvitestatus The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByShareInvitestatus($shareInvitestatus = null, $comparison = null)
    {
        if (is_string($shareInvitestatus)) {
            $shareInvitestatus = in_array(strtolower($shareInvitestatus), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_SHARE_INVITESTATUS, $shareInvitestatus, $comparison);
    }

    /**
     * Filter the query on the grpid column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupId(1234); // WHERE grpid = 1234
     * $query->filterByGroupId(array(12, 34)); // WHERE grpid IN (12, 34)
     * $query->filterByGroupId(array('min' => 12)); // WHERE grpid > 12
     * </code>
     *
     * @param     mixed $groupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByGroupId($groupId = null, $comparison = null)
    {
        if (is_array($groupId)) {
            $useMinMax = false;
            if (isset($groupId['min'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_GRPID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_GRPID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_GRPID, $groupId, $comparison);
    }

    /**
     * Filter the query on the cal_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType(1234); // WHERE cal_type = 1234
     * $query->filterByType(array(12, 34)); // WHERE cal_type IN (12, 34)
     * $query->filterByType(array('min' => 12)); // WHERE cal_type > 12
     * </code>
     *
     * @param     mixed $type The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_array($type)) {
            $useMinMax = false;
            if (isset($type['min'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_CAL_TYPE, $type['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($type['max'])) {
                $this->addUsingAlias(CalendarinstancesTableMap::COL_CAL_TYPE, $type['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarinstancesTableMap::COL_CAL_TYPE, $type, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCalendarinstances $calendarinstances Object to remove from the list of results
     *
     * @return $this|ChildCalendarinstancesQuery The current query, for fluid interface
     */
    public function prune($calendarinstances = null)
    {
        if ($calendarinstances) {
            $this->addUsingAlias(CalendarinstancesTableMap::COL_ID, $calendarinstances->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the calendarinstances table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarinstancesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CalendarinstancesTableMap::clearInstancePool();
            CalendarinstancesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarinstancesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CalendarinstancesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CalendarinstancesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CalendarinstancesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CalendarinstancesQuery
