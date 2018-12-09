<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Calendarsubscriptions as ChildCalendarsubscriptions;
use EcclesiaCRM\CalendarsubscriptionsQuery as ChildCalendarsubscriptionsQuery;
use EcclesiaCRM\Map\CalendarsubscriptionsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'calendarsubscriptions' table.
 *
 * Calendar management
 *
 * @method     ChildCalendarsubscriptionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCalendarsubscriptionsQuery orderByUri($order = Criteria::ASC) Order by the uri column
 * @method     ChildCalendarsubscriptionsQuery orderByPrincipaluri($order = Criteria::ASC) Order by the principaluri column
 * @method     ChildCalendarsubscriptionsQuery orderBySource($order = Criteria::ASC) Order by the source column
 * @method     ChildCalendarsubscriptionsQuery orderByDisplayname($order = Criteria::ASC) Order by the displayname column
 * @method     ChildCalendarsubscriptionsQuery orderByRefreshrate($order = Criteria::ASC) Order by the refreshrate column
 * @method     ChildCalendarsubscriptionsQuery orderByCalendarorder($order = Criteria::ASC) Order by the calendarorder column
 * @method     ChildCalendarsubscriptionsQuery orderByCalendarcolor($order = Criteria::ASC) Order by the calendarcolor column
 * @method     ChildCalendarsubscriptionsQuery orderByStriptodos($order = Criteria::ASC) Order by the striptodos column
 * @method     ChildCalendarsubscriptionsQuery orderByStripalarms($order = Criteria::ASC) Order by the stripalarms column
 * @method     ChildCalendarsubscriptionsQuery orderByStripattachments($order = Criteria::ASC) Order by the stripattachments column
 * @method     ChildCalendarsubscriptionsQuery orderByLastmodified($order = Criteria::ASC) Order by the lastmodified column
 *
 * @method     ChildCalendarsubscriptionsQuery groupById() Group by the id column
 * @method     ChildCalendarsubscriptionsQuery groupByUri() Group by the uri column
 * @method     ChildCalendarsubscriptionsQuery groupByPrincipaluri() Group by the principaluri column
 * @method     ChildCalendarsubscriptionsQuery groupBySource() Group by the source column
 * @method     ChildCalendarsubscriptionsQuery groupByDisplayname() Group by the displayname column
 * @method     ChildCalendarsubscriptionsQuery groupByRefreshrate() Group by the refreshrate column
 * @method     ChildCalendarsubscriptionsQuery groupByCalendarorder() Group by the calendarorder column
 * @method     ChildCalendarsubscriptionsQuery groupByCalendarcolor() Group by the calendarcolor column
 * @method     ChildCalendarsubscriptionsQuery groupByStriptodos() Group by the striptodos column
 * @method     ChildCalendarsubscriptionsQuery groupByStripalarms() Group by the stripalarms column
 * @method     ChildCalendarsubscriptionsQuery groupByStripattachments() Group by the stripattachments column
 * @method     ChildCalendarsubscriptionsQuery groupByLastmodified() Group by the lastmodified column
 *
 * @method     ChildCalendarsubscriptionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCalendarsubscriptionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCalendarsubscriptionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCalendarsubscriptionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCalendarsubscriptionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCalendarsubscriptionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCalendarsubscriptions findOne(ConnectionInterface $con = null) Return the first ChildCalendarsubscriptions matching the query
 * @method     ChildCalendarsubscriptions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCalendarsubscriptions matching the query, or a new ChildCalendarsubscriptions object populated from the query conditions when no match is found
 *
 * @method     ChildCalendarsubscriptions findOneById(int $id) Return the first ChildCalendarsubscriptions filtered by the id column
 * @method     ChildCalendarsubscriptions findOneByUri(string $uri) Return the first ChildCalendarsubscriptions filtered by the uri column
 * @method     ChildCalendarsubscriptions findOneByPrincipaluri(string $principaluri) Return the first ChildCalendarsubscriptions filtered by the principaluri column
 * @method     ChildCalendarsubscriptions findOneBySource(string $source) Return the first ChildCalendarsubscriptions filtered by the source column
 * @method     ChildCalendarsubscriptions findOneByDisplayname(string $displayname) Return the first ChildCalendarsubscriptions filtered by the displayname column
 * @method     ChildCalendarsubscriptions findOneByRefreshrate(string $refreshrate) Return the first ChildCalendarsubscriptions filtered by the refreshrate column
 * @method     ChildCalendarsubscriptions findOneByCalendarorder(int $calendarorder) Return the first ChildCalendarsubscriptions filtered by the calendarorder column
 * @method     ChildCalendarsubscriptions findOneByCalendarcolor(string $calendarcolor) Return the first ChildCalendarsubscriptions filtered by the calendarcolor column
 * @method     ChildCalendarsubscriptions findOneByStriptodos(boolean $striptodos) Return the first ChildCalendarsubscriptions filtered by the striptodos column
 * @method     ChildCalendarsubscriptions findOneByStripalarms(boolean $stripalarms) Return the first ChildCalendarsubscriptions filtered by the stripalarms column
 * @method     ChildCalendarsubscriptions findOneByStripattachments(boolean $stripattachments) Return the first ChildCalendarsubscriptions filtered by the stripattachments column
 * @method     ChildCalendarsubscriptions findOneByLastmodified(int $lastmodified) Return the first ChildCalendarsubscriptions filtered by the lastmodified column *

 * @method     ChildCalendarsubscriptions requirePk($key, ConnectionInterface $con = null) Return the ChildCalendarsubscriptions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOne(ConnectionInterface $con = null) Return the first ChildCalendarsubscriptions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCalendarsubscriptions requireOneById(int $id) Return the first ChildCalendarsubscriptions filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByUri(string $uri) Return the first ChildCalendarsubscriptions filtered by the uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByPrincipaluri(string $principaluri) Return the first ChildCalendarsubscriptions filtered by the principaluri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneBySource(string $source) Return the first ChildCalendarsubscriptions filtered by the source column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByDisplayname(string $displayname) Return the first ChildCalendarsubscriptions filtered by the displayname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByRefreshrate(string $refreshrate) Return the first ChildCalendarsubscriptions filtered by the refreshrate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByCalendarorder(int $calendarorder) Return the first ChildCalendarsubscriptions filtered by the calendarorder column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByCalendarcolor(string $calendarcolor) Return the first ChildCalendarsubscriptions filtered by the calendarcolor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByStriptodos(boolean $striptodos) Return the first ChildCalendarsubscriptions filtered by the striptodos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByStripalarms(boolean $stripalarms) Return the first ChildCalendarsubscriptions filtered by the stripalarms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByStripattachments(boolean $stripattachments) Return the first ChildCalendarsubscriptions filtered by the stripattachments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendarsubscriptions requireOneByLastmodified(int $lastmodified) Return the first ChildCalendarsubscriptions filtered by the lastmodified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCalendarsubscriptions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCalendarsubscriptions objects based on current ModelCriteria
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findById(int $id) Return ChildCalendarsubscriptions objects filtered by the id column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByUri(string $uri) Return ChildCalendarsubscriptions objects filtered by the uri column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByPrincipaluri(string $principaluri) Return ChildCalendarsubscriptions objects filtered by the principaluri column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findBySource(string $source) Return ChildCalendarsubscriptions objects filtered by the source column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByDisplayname(string $displayname) Return ChildCalendarsubscriptions objects filtered by the displayname column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByRefreshrate(string $refreshrate) Return ChildCalendarsubscriptions objects filtered by the refreshrate column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByCalendarorder(int $calendarorder) Return ChildCalendarsubscriptions objects filtered by the calendarorder column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByCalendarcolor(string $calendarcolor) Return ChildCalendarsubscriptions objects filtered by the calendarcolor column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByStriptodos(boolean $striptodos) Return ChildCalendarsubscriptions objects filtered by the striptodos column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByStripalarms(boolean $stripalarms) Return ChildCalendarsubscriptions objects filtered by the stripalarms column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByStripattachments(boolean $stripattachments) Return ChildCalendarsubscriptions objects filtered by the stripattachments column
 * @method     ChildCalendarsubscriptions[]|ObjectCollection findByLastmodified(int $lastmodified) Return ChildCalendarsubscriptions objects filtered by the lastmodified column
 * @method     ChildCalendarsubscriptions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CalendarsubscriptionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\CalendarsubscriptionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Calendarsubscriptions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCalendarsubscriptionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCalendarsubscriptionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCalendarsubscriptionsQuery) {
            return $criteria;
        }
        $query = new ChildCalendarsubscriptionsQuery();
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
     * @return ChildCalendarsubscriptions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CalendarsubscriptionsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CalendarsubscriptionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCalendarsubscriptions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, uri, principaluri, source, displayname, refreshrate, calendarorder, calendarcolor, striptodos, stripalarms, stripattachments, lastmodified FROM calendarsubscriptions WHERE id = :p0';
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
            /** @var ChildCalendarsubscriptions $obj */
            $obj = new ChildCalendarsubscriptions();
            $obj->hydrate($row);
            CalendarsubscriptionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCalendarsubscriptions|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_URI, $uri, $comparison);
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
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByPrincipaluri($principaluri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($principaluri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_PRINCIPALURI, $principaluri, $comparison);
    }

    /**
     * Filter the query on the source column
     *
     * Example usage:
     * <code>
     * $query->filterBySource('fooValue');   // WHERE source = 'fooValue'
     * $query->filterBySource('%fooValue%', Criteria::LIKE); // WHERE source LIKE '%fooValue%'
     * </code>
     *
     * @param     string $source The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterBySource($source = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($source)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_SOURCE, $source, $comparison);
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
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByDisplayname($displayname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($displayname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_DISPLAYNAME, $displayname, $comparison);
    }

    /**
     * Filter the query on the refreshrate column
     *
     * Example usage:
     * <code>
     * $query->filterByRefreshrate('fooValue');   // WHERE refreshrate = 'fooValue'
     * $query->filterByRefreshrate('%fooValue%', Criteria::LIKE); // WHERE refreshrate LIKE '%fooValue%'
     * </code>
     *
     * @param     string $refreshrate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByRefreshrate($refreshrate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($refreshrate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_REFRESHRATE, $refreshrate, $comparison);
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
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByCalendarorder($calendarorder = null, $comparison = null)
    {
        if (is_array($calendarorder)) {
            $useMinMax = false;
            if (isset($calendarorder['min'])) {
                $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_CALENDARORDER, $calendarorder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calendarorder['max'])) {
                $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_CALENDARORDER, $calendarorder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_CALENDARORDER, $calendarorder, $comparison);
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
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByCalendarcolor($calendarcolor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calendarcolor)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_CALENDARCOLOR, $calendarcolor, $comparison);
    }

    /**
     * Filter the query on the striptodos column
     *
     * Example usage:
     * <code>
     * $query->filterByStriptodos(true); // WHERE striptodos = true
     * $query->filterByStriptodos('yes'); // WHERE striptodos = true
     * </code>
     *
     * @param     boolean|string $striptodos The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByStriptodos($striptodos = null, $comparison = null)
    {
        if (is_string($striptodos)) {
            $striptodos = in_array(strtolower($striptodos), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_STRIPTODOS, $striptodos, $comparison);
    }

    /**
     * Filter the query on the stripalarms column
     *
     * Example usage:
     * <code>
     * $query->filterByStripalarms(true); // WHERE stripalarms = true
     * $query->filterByStripalarms('yes'); // WHERE stripalarms = true
     * </code>
     *
     * @param     boolean|string $stripalarms The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByStripalarms($stripalarms = null, $comparison = null)
    {
        if (is_string($stripalarms)) {
            $stripalarms = in_array(strtolower($stripalarms), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_STRIPALARMS, $stripalarms, $comparison);
    }

    /**
     * Filter the query on the stripattachments column
     *
     * Example usage:
     * <code>
     * $query->filterByStripattachments(true); // WHERE stripattachments = true
     * $query->filterByStripattachments('yes'); // WHERE stripattachments = true
     * </code>
     *
     * @param     boolean|string $stripattachments The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByStripattachments($stripattachments = null, $comparison = null)
    {
        if (is_string($stripattachments)) {
            $stripattachments = in_array(strtolower($stripattachments), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_STRIPATTACHMENTS, $stripattachments, $comparison);
    }

    /**
     * Filter the query on the lastmodified column
     *
     * Example usage:
     * <code>
     * $query->filterByLastmodified(1234); // WHERE lastmodified = 1234
     * $query->filterByLastmodified(array(12, 34)); // WHERE lastmodified IN (12, 34)
     * $query->filterByLastmodified(array('min' => 12)); // WHERE lastmodified > 12
     * </code>
     *
     * @param     mixed $lastmodified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function filterByLastmodified($lastmodified = null, $comparison = null)
    {
        if (is_array($lastmodified)) {
            $useMinMax = false;
            if (isset($lastmodified['min'])) {
                $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_LASTMODIFIED, $lastmodified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastmodified['max'])) {
                $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_LASTMODIFIED, $lastmodified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_LASTMODIFIED, $lastmodified, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCalendarsubscriptions $calendarsubscriptions Object to remove from the list of results
     *
     * @return $this|ChildCalendarsubscriptionsQuery The current query, for fluid interface
     */
    public function prune($calendarsubscriptions = null)
    {
        if ($calendarsubscriptions) {
            $this->addUsingAlias(CalendarsubscriptionsTableMap::COL_ID, $calendarsubscriptions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the calendarsubscriptions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarsubscriptionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CalendarsubscriptionsTableMap::clearInstancePool();
            CalendarsubscriptionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarsubscriptionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CalendarsubscriptionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CalendarsubscriptionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CalendarsubscriptionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CalendarsubscriptionsQuery
