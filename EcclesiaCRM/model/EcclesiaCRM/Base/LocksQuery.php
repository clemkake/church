<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Locks as ChildLocks;
use EcclesiaCRM\LocksQuery as ChildLocksQuery;
use EcclesiaCRM\Map\LocksTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'locks' table.
 *
 * Calendar management
 *
 * @method     ChildLocksQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLocksQuery orderByOwner($order = Criteria::ASC) Order by the owner column
 * @method     ChildLocksQuery orderByTimeout($order = Criteria::ASC) Order by the timeout column
 * @method     ChildLocksQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildLocksQuery orderByToken($order = Criteria::ASC) Order by the token column
 * @method     ChildLocksQuery orderByScope($order = Criteria::ASC) Order by the scope column
 * @method     ChildLocksQuery orderByDepth($order = Criteria::ASC) Order by the depth column
 * @method     ChildLocksQuery orderByUri($order = Criteria::ASC) Order by the uri column
 *
 * @method     ChildLocksQuery groupById() Group by the id column
 * @method     ChildLocksQuery groupByOwner() Group by the owner column
 * @method     ChildLocksQuery groupByTimeout() Group by the timeout column
 * @method     ChildLocksQuery groupByCreated() Group by the created column
 * @method     ChildLocksQuery groupByToken() Group by the token column
 * @method     ChildLocksQuery groupByScope() Group by the scope column
 * @method     ChildLocksQuery groupByDepth() Group by the depth column
 * @method     ChildLocksQuery groupByUri() Group by the uri column
 *
 * @method     ChildLocksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLocksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLocksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLocksQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLocksQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLocksQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLocks findOne(ConnectionInterface $con = null) Return the first ChildLocks matching the query
 * @method     ChildLocks findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLocks matching the query, or a new ChildLocks object populated from the query conditions when no match is found
 *
 * @method     ChildLocks findOneById(int $id) Return the first ChildLocks filtered by the id column
 * @method     ChildLocks findOneByOwner(string $owner) Return the first ChildLocks filtered by the owner column
 * @method     ChildLocks findOneByTimeout(int $timeout) Return the first ChildLocks filtered by the timeout column
 * @method     ChildLocks findOneByCreated(int $created) Return the first ChildLocks filtered by the created column
 * @method     ChildLocks findOneByToken(string $token) Return the first ChildLocks filtered by the token column
 * @method     ChildLocks findOneByScope(int $scope) Return the first ChildLocks filtered by the scope column
 * @method     ChildLocks findOneByDepth(int $depth) Return the first ChildLocks filtered by the depth column
 * @method     ChildLocks findOneByUri(string $uri) Return the first ChildLocks filtered by the uri column *

 * @method     ChildLocks requirePk($key, ConnectionInterface $con = null) Return the ChildLocks by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocks requireOne(ConnectionInterface $con = null) Return the first ChildLocks matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLocks requireOneById(int $id) Return the first ChildLocks filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocks requireOneByOwner(string $owner) Return the first ChildLocks filtered by the owner column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocks requireOneByTimeout(int $timeout) Return the first ChildLocks filtered by the timeout column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocks requireOneByCreated(int $created) Return the first ChildLocks filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocks requireOneByToken(string $token) Return the first ChildLocks filtered by the token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocks requireOneByScope(int $scope) Return the first ChildLocks filtered by the scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocks requireOneByDepth(int $depth) Return the first ChildLocks filtered by the depth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocks requireOneByUri(string $uri) Return the first ChildLocks filtered by the uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLocks[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLocks objects based on current ModelCriteria
 * @method     ChildLocks[]|ObjectCollection findById(int $id) Return ChildLocks objects filtered by the id column
 * @method     ChildLocks[]|ObjectCollection findByOwner(string $owner) Return ChildLocks objects filtered by the owner column
 * @method     ChildLocks[]|ObjectCollection findByTimeout(int $timeout) Return ChildLocks objects filtered by the timeout column
 * @method     ChildLocks[]|ObjectCollection findByCreated(int $created) Return ChildLocks objects filtered by the created column
 * @method     ChildLocks[]|ObjectCollection findByToken(string $token) Return ChildLocks objects filtered by the token column
 * @method     ChildLocks[]|ObjectCollection findByScope(int $scope) Return ChildLocks objects filtered by the scope column
 * @method     ChildLocks[]|ObjectCollection findByDepth(int $depth) Return ChildLocks objects filtered by the depth column
 * @method     ChildLocks[]|ObjectCollection findByUri(string $uri) Return ChildLocks objects filtered by the uri column
 * @method     ChildLocks[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LocksQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\LocksQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Locks', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLocksQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLocksQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLocksQuery) {
            return $criteria;
        }
        $query = new ChildLocksQuery();
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
     * @return ChildLocks|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LocksTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LocksTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLocks A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, owner, timeout, created, token, scope, depth, uri FROM locks WHERE id = :p0';
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
            /** @var ChildLocks $obj */
            $obj = new ChildLocks();
            $obj->hydrate($row);
            LocksTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLocks|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LocksTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LocksTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LocksTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LocksTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocksTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the owner column
     *
     * Example usage:
     * <code>
     * $query->filterByOwner('fooValue');   // WHERE owner = 'fooValue'
     * $query->filterByOwner('%fooValue%', Criteria::LIKE); // WHERE owner LIKE '%fooValue%'
     * </code>
     *
     * @param     string $owner The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterByOwner($owner = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($owner)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocksTableMap::COL_OWNER, $owner, $comparison);
    }

    /**
     * Filter the query on the timeout column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeout(1234); // WHERE timeout = 1234
     * $query->filterByTimeout(array(12, 34)); // WHERE timeout IN (12, 34)
     * $query->filterByTimeout(array('min' => 12)); // WHERE timeout > 12
     * </code>
     *
     * @param     mixed $timeout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterByTimeout($timeout = null, $comparison = null)
    {
        if (is_array($timeout)) {
            $useMinMax = false;
            if (isset($timeout['min'])) {
                $this->addUsingAlias(LocksTableMap::COL_TIMEOUT, $timeout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timeout['max'])) {
                $this->addUsingAlias(LocksTableMap::COL_TIMEOUT, $timeout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocksTableMap::COL_TIMEOUT, $timeout, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated(1234); // WHERE created = 1234
     * $query->filterByCreated(array(12, 34)); // WHERE created IN (12, 34)
     * $query->filterByCreated(array('min' => 12)); // WHERE created > 12
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(LocksTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(LocksTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocksTableMap::COL_CREATED, $created, $comparison);
    }

    /**
     * Filter the query on the token column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE token = 'fooValue'
     * $query->filterByToken('%fooValue%', Criteria::LIKE); // WHERE token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $token The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterByToken($token = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocksTableMap::COL_TOKEN, $token, $comparison);
    }

    /**
     * Filter the query on the scope column
     *
     * Example usage:
     * <code>
     * $query->filterByScope(1234); // WHERE scope = 1234
     * $query->filterByScope(array(12, 34)); // WHERE scope IN (12, 34)
     * $query->filterByScope(array('min' => 12)); // WHERE scope > 12
     * </code>
     *
     * @param     mixed $scope The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterByScope($scope = null, $comparison = null)
    {
        if (is_array($scope)) {
            $useMinMax = false;
            if (isset($scope['min'])) {
                $this->addUsingAlias(LocksTableMap::COL_SCOPE, $scope['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scope['max'])) {
                $this->addUsingAlias(LocksTableMap::COL_SCOPE, $scope['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocksTableMap::COL_SCOPE, $scope, $comparison);
    }

    /**
     * Filter the query on the depth column
     *
     * Example usage:
     * <code>
     * $query->filterByDepth(1234); // WHERE depth = 1234
     * $query->filterByDepth(array(12, 34)); // WHERE depth IN (12, 34)
     * $query->filterByDepth(array('min' => 12)); // WHERE depth > 12
     * </code>
     *
     * @param     mixed $depth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterByDepth($depth = null, $comparison = null)
    {
        if (is_array($depth)) {
            $useMinMax = false;
            if (isset($depth['min'])) {
                $this->addUsingAlias(LocksTableMap::COL_DEPTH, $depth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($depth['max'])) {
                $this->addUsingAlias(LocksTableMap::COL_DEPTH, $depth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocksTableMap::COL_DEPTH, $depth, $comparison);
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
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocksTableMap::COL_URI, $uri, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLocks $locks Object to remove from the list of results
     *
     * @return $this|ChildLocksQuery The current query, for fluid interface
     */
    public function prune($locks = null)
    {
        if ($locks) {
            $this->addUsingAlias(LocksTableMap::COL_ID, $locks->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the locks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LocksTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LocksTableMap::clearInstancePool();
            LocksTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LocksTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LocksTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LocksTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LocksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LocksQuery
