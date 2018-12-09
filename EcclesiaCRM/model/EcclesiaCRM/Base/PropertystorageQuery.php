<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Propertystorage as ChildPropertystorage;
use EcclesiaCRM\PropertystorageQuery as ChildPropertystorageQuery;
use EcclesiaCRM\Map\PropertystorageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'propertystorage' table.
 *
 * Calendar management
 *
 * @method     ChildPropertystorageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPropertystorageQuery orderByPath($order = Criteria::ASC) Order by the path column
 * @method     ChildPropertystorageQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPropertystorageQuery orderByValuetype($order = Criteria::ASC) Order by the valuetype column
 * @method     ChildPropertystorageQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildPropertystorageQuery groupById() Group by the id column
 * @method     ChildPropertystorageQuery groupByPath() Group by the path column
 * @method     ChildPropertystorageQuery groupByName() Group by the name column
 * @method     ChildPropertystorageQuery groupByValuetype() Group by the valuetype column
 * @method     ChildPropertystorageQuery groupByValue() Group by the value column
 *
 * @method     ChildPropertystorageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPropertystorageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPropertystorageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPropertystorageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPropertystorageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPropertystorageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPropertystorage findOne(ConnectionInterface $con = null) Return the first ChildPropertystorage matching the query
 * @method     ChildPropertystorage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPropertystorage matching the query, or a new ChildPropertystorage object populated from the query conditions when no match is found
 *
 * @method     ChildPropertystorage findOneById(int $id) Return the first ChildPropertystorage filtered by the id column
 * @method     ChildPropertystorage findOneByPath(string $path) Return the first ChildPropertystorage filtered by the path column
 * @method     ChildPropertystorage findOneByName(string $name) Return the first ChildPropertystorage filtered by the name column
 * @method     ChildPropertystorage findOneByValuetype(int $valuetype) Return the first ChildPropertystorage filtered by the valuetype column
 * @method     ChildPropertystorage findOneByValue(string $value) Return the first ChildPropertystorage filtered by the value column *

 * @method     ChildPropertystorage requirePk($key, ConnectionInterface $con = null) Return the ChildPropertystorage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPropertystorage requireOne(ConnectionInterface $con = null) Return the first ChildPropertystorage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPropertystorage requireOneById(int $id) Return the first ChildPropertystorage filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPropertystorage requireOneByPath(string $path) Return the first ChildPropertystorage filtered by the path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPropertystorage requireOneByName(string $name) Return the first ChildPropertystorage filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPropertystorage requireOneByValuetype(int $valuetype) Return the first ChildPropertystorage filtered by the valuetype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPropertystorage requireOneByValue(string $value) Return the first ChildPropertystorage filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPropertystorage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPropertystorage objects based on current ModelCriteria
 * @method     ChildPropertystorage[]|ObjectCollection findById(int $id) Return ChildPropertystorage objects filtered by the id column
 * @method     ChildPropertystorage[]|ObjectCollection findByPath(string $path) Return ChildPropertystorage objects filtered by the path column
 * @method     ChildPropertystorage[]|ObjectCollection findByName(string $name) Return ChildPropertystorage objects filtered by the name column
 * @method     ChildPropertystorage[]|ObjectCollection findByValuetype(int $valuetype) Return ChildPropertystorage objects filtered by the valuetype column
 * @method     ChildPropertystorage[]|ObjectCollection findByValue(string $value) Return ChildPropertystorage objects filtered by the value column
 * @method     ChildPropertystorage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PropertystorageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\PropertystorageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Propertystorage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPropertystorageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPropertystorageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPropertystorageQuery) {
            return $criteria;
        }
        $query = new ChildPropertystorageQuery();
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
     * @return ChildPropertystorage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PropertystorageTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PropertystorageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPropertystorage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, path, name, valuetype, value FROM propertystorage WHERE id = :p0';
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
            /** @var ChildPropertystorage $obj */
            $obj = new ChildPropertystorage();
            $obj->hydrate($row);
            PropertystorageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPropertystorage|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPropertystorageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PropertystorageTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPropertystorageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PropertystorageTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPropertystorageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PropertystorageTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PropertystorageTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertystorageTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the path column
     *
     * Example usage:
     * <code>
     * $query->filterByPath('fooValue');   // WHERE path = 'fooValue'
     * $query->filterByPath('%fooValue%', Criteria::LIKE); // WHERE path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $path The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertystorageQuery The current query, for fluid interface
     */
    public function filterByPath($path = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($path)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertystorageTableMap::COL_PATH, $path, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertystorageQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertystorageTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the valuetype column
     *
     * Example usage:
     * <code>
     * $query->filterByValuetype(1234); // WHERE valuetype = 1234
     * $query->filterByValuetype(array(12, 34)); // WHERE valuetype IN (12, 34)
     * $query->filterByValuetype(array('min' => 12)); // WHERE valuetype > 12
     * </code>
     *
     * @param     mixed $valuetype The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertystorageQuery The current query, for fluid interface
     */
    public function filterByValuetype($valuetype = null, $comparison = null)
    {
        if (is_array($valuetype)) {
            $useMinMax = false;
            if (isset($valuetype['min'])) {
                $this->addUsingAlias(PropertystorageTableMap::COL_VALUETYPE, $valuetype['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($valuetype['max'])) {
                $this->addUsingAlias(PropertystorageTableMap::COL_VALUETYPE, $valuetype['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertystorageTableMap::COL_VALUETYPE, $valuetype, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * @param     mixed $value The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertystorageQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {

        return $this->addUsingAlias(PropertystorageTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPropertystorage $propertystorage Object to remove from the list of results
     *
     * @return $this|ChildPropertystorageQuery The current query, for fluid interface
     */
    public function prune($propertystorage = null)
    {
        if ($propertystorage) {
            $this->addUsingAlias(PropertystorageTableMap::COL_ID, $propertystorage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the propertystorage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertystorageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PropertystorageTableMap::clearInstancePool();
            PropertystorageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PropertystorageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PropertystorageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PropertystorageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PropertystorageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PropertystorageQuery
