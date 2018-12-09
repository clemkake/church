<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Calendars as ChildCalendars;
use EcclesiaCRM\CalendarsQuery as ChildCalendarsQuery;
use EcclesiaCRM\Map\CalendarsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'calendars' table.
 *
 * Calendar management
 *
 * @method     ChildCalendarsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCalendarsQuery orderBySynctoken($order = Criteria::ASC) Order by the synctoken column
 * @method     ChildCalendarsQuery orderByComponents($order = Criteria::ASC) Order by the components column
 *
 * @method     ChildCalendarsQuery groupById() Group by the id column
 * @method     ChildCalendarsQuery groupBySynctoken() Group by the synctoken column
 * @method     ChildCalendarsQuery groupByComponents() Group by the components column
 *
 * @method     ChildCalendarsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCalendarsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCalendarsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCalendarsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCalendarsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCalendarsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCalendars findOne(ConnectionInterface $con = null) Return the first ChildCalendars matching the query
 * @method     ChildCalendars findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCalendars matching the query, or a new ChildCalendars object populated from the query conditions when no match is found
 *
 * @method     ChildCalendars findOneById(int $id) Return the first ChildCalendars filtered by the id column
 * @method     ChildCalendars findOneBySynctoken(int $synctoken) Return the first ChildCalendars filtered by the synctoken column
 * @method     ChildCalendars findOneByComponents(string $components) Return the first ChildCalendars filtered by the components column *

 * @method     ChildCalendars requirePk($key, ConnectionInterface $con = null) Return the ChildCalendars by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendars requireOne(ConnectionInterface $con = null) Return the first ChildCalendars matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCalendars requireOneById(int $id) Return the first ChildCalendars filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendars requireOneBySynctoken(int $synctoken) Return the first ChildCalendars filtered by the synctoken column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendars requireOneByComponents(string $components) Return the first ChildCalendars filtered by the components column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCalendars[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCalendars objects based on current ModelCriteria
 * @method     ChildCalendars[]|ObjectCollection findById(int $id) Return ChildCalendars objects filtered by the id column
 * @method     ChildCalendars[]|ObjectCollection findBySynctoken(int $synctoken) Return ChildCalendars objects filtered by the synctoken column
 * @method     ChildCalendars[]|ObjectCollection findByComponents(string $components) Return ChildCalendars objects filtered by the components column
 * @method     ChildCalendars[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CalendarsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\CalendarsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Calendars', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCalendarsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCalendarsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCalendarsQuery) {
            return $criteria;
        }
        $query = new ChildCalendarsQuery();
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
     * @return ChildCalendars|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CalendarsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CalendarsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCalendars A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, synctoken, components FROM calendars WHERE id = :p0';
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
            /** @var ChildCalendars $obj */
            $obj = new ChildCalendars();
            $obj->hydrate($row);
            CalendarsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCalendars|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCalendarsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CalendarsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCalendarsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CalendarsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCalendarsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CalendarsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CalendarsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the synctoken column
     *
     * Example usage:
     * <code>
     * $query->filterBySynctoken(1234); // WHERE synctoken = 1234
     * $query->filterBySynctoken(array(12, 34)); // WHERE synctoken IN (12, 34)
     * $query->filterBySynctoken(array('min' => 12)); // WHERE synctoken > 12
     * </code>
     *
     * @param     mixed $synctoken The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarsQuery The current query, for fluid interface
     */
    public function filterBySynctoken($synctoken = null, $comparison = null)
    {
        if (is_array($synctoken)) {
            $useMinMax = false;
            if (isset($synctoken['min'])) {
                $this->addUsingAlias(CalendarsTableMap::COL_SYNCTOKEN, $synctoken['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($synctoken['max'])) {
                $this->addUsingAlias(CalendarsTableMap::COL_SYNCTOKEN, $synctoken['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsTableMap::COL_SYNCTOKEN, $synctoken, $comparison);
    }

    /**
     * Filter the query on the components column
     *
     * Example usage:
     * <code>
     * $query->filterByComponents('fooValue');   // WHERE components = 'fooValue'
     * $query->filterByComponents('%fooValue%', Criteria::LIKE); // WHERE components LIKE '%fooValue%'
     * </code>
     *
     * @param     string $components The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarsQuery The current query, for fluid interface
     */
    public function filterByComponents($components = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($components)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarsTableMap::COL_COMPONENTS, $components, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCalendars $calendars Object to remove from the list of results
     *
     * @return $this|ChildCalendarsQuery The current query, for fluid interface
     */
    public function prune($calendars = null)
    {
        if ($calendars) {
            $this->addUsingAlias(CalendarsTableMap::COL_ID, $calendars->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the calendars table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CalendarsTableMap::clearInstancePool();
            CalendarsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CalendarsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CalendarsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CalendarsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CalendarsQuery
