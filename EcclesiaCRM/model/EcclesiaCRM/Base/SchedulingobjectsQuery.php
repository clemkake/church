<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Schedulingobjects as ChildSchedulingobjects;
use EcclesiaCRM\SchedulingobjectsQuery as ChildSchedulingobjectsQuery;
use EcclesiaCRM\Map\SchedulingobjectsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'schedulingobjects' table.
 *
 * Calendar management
 *
 * @method     ChildSchedulingobjectsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSchedulingobjectsQuery orderByPrincipaluri($order = Criteria::ASC) Order by the principaluri column
 * @method     ChildSchedulingobjectsQuery orderByCalendardata($order = Criteria::ASC) Order by the calendardata column
 * @method     ChildSchedulingobjectsQuery orderByUri($order = Criteria::ASC) Order by the uri column
 * @method     ChildSchedulingobjectsQuery orderByLastmodified($order = Criteria::ASC) Order by the lastmodified column
 * @method     ChildSchedulingobjectsQuery orderByEtag($order = Criteria::ASC) Order by the etag column
 * @method     ChildSchedulingobjectsQuery orderBySize($order = Criteria::ASC) Order by the size column
 *
 * @method     ChildSchedulingobjectsQuery groupById() Group by the id column
 * @method     ChildSchedulingobjectsQuery groupByPrincipaluri() Group by the principaluri column
 * @method     ChildSchedulingobjectsQuery groupByCalendardata() Group by the calendardata column
 * @method     ChildSchedulingobjectsQuery groupByUri() Group by the uri column
 * @method     ChildSchedulingobjectsQuery groupByLastmodified() Group by the lastmodified column
 * @method     ChildSchedulingobjectsQuery groupByEtag() Group by the etag column
 * @method     ChildSchedulingobjectsQuery groupBySize() Group by the size column
 *
 * @method     ChildSchedulingobjectsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSchedulingobjectsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSchedulingobjectsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSchedulingobjectsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSchedulingobjectsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSchedulingobjectsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSchedulingobjects findOne(ConnectionInterface $con = null) Return the first ChildSchedulingobjects matching the query
 * @method     ChildSchedulingobjects findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSchedulingobjects matching the query, or a new ChildSchedulingobjects object populated from the query conditions when no match is found
 *
 * @method     ChildSchedulingobjects findOneById(int $id) Return the first ChildSchedulingobjects filtered by the id column
 * @method     ChildSchedulingobjects findOneByPrincipaluri(string $principaluri) Return the first ChildSchedulingobjects filtered by the principaluri column
 * @method     ChildSchedulingobjects findOneByCalendardata(string $calendardata) Return the first ChildSchedulingobjects filtered by the calendardata column
 * @method     ChildSchedulingobjects findOneByUri(string $uri) Return the first ChildSchedulingobjects filtered by the uri column
 * @method     ChildSchedulingobjects findOneByLastmodified(int $lastmodified) Return the first ChildSchedulingobjects filtered by the lastmodified column
 * @method     ChildSchedulingobjects findOneByEtag(string $etag) Return the first ChildSchedulingobjects filtered by the etag column
 * @method     ChildSchedulingobjects findOneBySize(int $size) Return the first ChildSchedulingobjects filtered by the size column *

 * @method     ChildSchedulingobjects requirePk($key, ConnectionInterface $con = null) Return the ChildSchedulingobjects by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedulingobjects requireOne(ConnectionInterface $con = null) Return the first ChildSchedulingobjects matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSchedulingobjects requireOneById(int $id) Return the first ChildSchedulingobjects filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedulingobjects requireOneByPrincipaluri(string $principaluri) Return the first ChildSchedulingobjects filtered by the principaluri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedulingobjects requireOneByCalendardata(string $calendardata) Return the first ChildSchedulingobjects filtered by the calendardata column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedulingobjects requireOneByUri(string $uri) Return the first ChildSchedulingobjects filtered by the uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedulingobjects requireOneByLastmodified(int $lastmodified) Return the first ChildSchedulingobjects filtered by the lastmodified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedulingobjects requireOneByEtag(string $etag) Return the first ChildSchedulingobjects filtered by the etag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSchedulingobjects requireOneBySize(int $size) Return the first ChildSchedulingobjects filtered by the size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSchedulingobjects[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSchedulingobjects objects based on current ModelCriteria
 * @method     ChildSchedulingobjects[]|ObjectCollection findById(int $id) Return ChildSchedulingobjects objects filtered by the id column
 * @method     ChildSchedulingobjects[]|ObjectCollection findByPrincipaluri(string $principaluri) Return ChildSchedulingobjects objects filtered by the principaluri column
 * @method     ChildSchedulingobjects[]|ObjectCollection findByCalendardata(string $calendardata) Return ChildSchedulingobjects objects filtered by the calendardata column
 * @method     ChildSchedulingobjects[]|ObjectCollection findByUri(string $uri) Return ChildSchedulingobjects objects filtered by the uri column
 * @method     ChildSchedulingobjects[]|ObjectCollection findByLastmodified(int $lastmodified) Return ChildSchedulingobjects objects filtered by the lastmodified column
 * @method     ChildSchedulingobjects[]|ObjectCollection findByEtag(string $etag) Return ChildSchedulingobjects objects filtered by the etag column
 * @method     ChildSchedulingobjects[]|ObjectCollection findBySize(int $size) Return ChildSchedulingobjects objects filtered by the size column
 * @method     ChildSchedulingobjects[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SchedulingobjectsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\SchedulingobjectsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Schedulingobjects', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSchedulingobjectsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSchedulingobjectsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSchedulingobjectsQuery) {
            return $criteria;
        }
        $query = new ChildSchedulingobjectsQuery();
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
     * @return ChildSchedulingobjects|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SchedulingobjectsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SchedulingobjectsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSchedulingobjects A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, principaluri, calendardata, uri, lastmodified, etag, size FROM schedulingobjects WHERE id = :p0';
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
            /** @var ChildSchedulingobjects $obj */
            $obj = new ChildSchedulingobjects();
            $obj->hydrate($row);
            SchedulingobjectsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSchedulingobjects|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SchedulingobjectsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SchedulingobjectsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SchedulingobjectsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SchedulingobjectsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SchedulingobjectsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function filterByPrincipaluri($principaluri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($principaluri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SchedulingobjectsTableMap::COL_PRINCIPALURI, $principaluri, $comparison);
    }

    /**
     * Filter the query on the calendardata column
     *
     * @param     mixed $calendardata The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function filterByCalendardata($calendardata = null, $comparison = null)
    {

        return $this->addUsingAlias(SchedulingobjectsTableMap::COL_CALENDARDATA, $calendardata, $comparison);
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
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SchedulingobjectsTableMap::COL_URI, $uri, $comparison);
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
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function filterByLastmodified($lastmodified = null, $comparison = null)
    {
        if (is_array($lastmodified)) {
            $useMinMax = false;
            if (isset($lastmodified['min'])) {
                $this->addUsingAlias(SchedulingobjectsTableMap::COL_LASTMODIFIED, $lastmodified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastmodified['max'])) {
                $this->addUsingAlias(SchedulingobjectsTableMap::COL_LASTMODIFIED, $lastmodified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SchedulingobjectsTableMap::COL_LASTMODIFIED, $lastmodified, $comparison);
    }

    /**
     * Filter the query on the etag column
     *
     * Example usage:
     * <code>
     * $query->filterByEtag('fooValue');   // WHERE etag = 'fooValue'
     * $query->filterByEtag('%fooValue%', Criteria::LIKE); // WHERE etag LIKE '%fooValue%'
     * </code>
     *
     * @param     string $etag The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function filterByEtag($etag = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($etag)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SchedulingobjectsTableMap::COL_ETAG, $etag, $comparison);
    }

    /**
     * Filter the query on the size column
     *
     * Example usage:
     * <code>
     * $query->filterBySize(1234); // WHERE size = 1234
     * $query->filterBySize(array(12, 34)); // WHERE size IN (12, 34)
     * $query->filterBySize(array('min' => 12)); // WHERE size > 12
     * </code>
     *
     * @param     mixed $size The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function filterBySize($size = null, $comparison = null)
    {
        if (is_array($size)) {
            $useMinMax = false;
            if (isset($size['min'])) {
                $this->addUsingAlias(SchedulingobjectsTableMap::COL_SIZE, $size['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($size['max'])) {
                $this->addUsingAlias(SchedulingobjectsTableMap::COL_SIZE, $size['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SchedulingobjectsTableMap::COL_SIZE, $size, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSchedulingobjects $schedulingobjects Object to remove from the list of results
     *
     * @return $this|ChildSchedulingobjectsQuery The current query, for fluid interface
     */
    public function prune($schedulingobjects = null)
    {
        if ($schedulingobjects) {
            $this->addUsingAlias(SchedulingobjectsTableMap::COL_ID, $schedulingobjects->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the schedulingobjects table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SchedulingobjectsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SchedulingobjectsTableMap::clearInstancePool();
            SchedulingobjectsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SchedulingobjectsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SchedulingobjectsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SchedulingobjectsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SchedulingobjectsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SchedulingobjectsQuery
