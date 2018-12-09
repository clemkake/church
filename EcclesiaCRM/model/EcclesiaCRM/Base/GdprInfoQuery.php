<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\GdprInfo as ChildGdprInfo;
use EcclesiaCRM\GdprInfoQuery as ChildGdprInfoQuery;
use EcclesiaCRM\Map\GdprInfoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'gdpr_infos' table.
 *
 *
 *
 * @method     ChildGdprInfoQuery orderById($order = Criteria::ASC) Order by the gdpr_info_id column
 * @method     ChildGdprInfoQuery orderByAbout($order = Criteria::ASC) Order by the gdpr_info_About column
 * @method     ChildGdprInfoQuery orderByName($order = Criteria::ASC) Order by the gdpr_info_Name column
 * @method     ChildGdprInfoQuery orderByTypeId($order = Criteria::ASC) Order by the gdpr_info_Type column
 * @method     ChildGdprInfoQuery orderByComment($order = Criteria::ASC) Order by the gdpr_info_comment column
 *
 * @method     ChildGdprInfoQuery groupById() Group by the gdpr_info_id column
 * @method     ChildGdprInfoQuery groupByAbout() Group by the gdpr_info_About column
 * @method     ChildGdprInfoQuery groupByName() Group by the gdpr_info_Name column
 * @method     ChildGdprInfoQuery groupByTypeId() Group by the gdpr_info_Type column
 * @method     ChildGdprInfoQuery groupByComment() Group by the gdpr_info_comment column
 *
 * @method     ChildGdprInfoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGdprInfoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGdprInfoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGdprInfoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGdprInfoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGdprInfoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGdprInfo findOne(ConnectionInterface $con = null) Return the first ChildGdprInfo matching the query
 * @method     ChildGdprInfo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGdprInfo matching the query, or a new ChildGdprInfo object populated from the query conditions when no match is found
 *
 * @method     ChildGdprInfo findOneById(int $gdpr_info_id) Return the first ChildGdprInfo filtered by the gdpr_info_id column
 * @method     ChildGdprInfo findOneByAbout(string $gdpr_info_About) Return the first ChildGdprInfo filtered by the gdpr_info_About column
 * @method     ChildGdprInfo findOneByName(string $gdpr_info_Name) Return the first ChildGdprInfo filtered by the gdpr_info_Name column
 * @method     ChildGdprInfo findOneByTypeId(int $gdpr_info_Type) Return the first ChildGdprInfo filtered by the gdpr_info_Type column
 * @method     ChildGdprInfo findOneByComment(string $gdpr_info_comment) Return the first ChildGdprInfo filtered by the gdpr_info_comment column *

 * @method     ChildGdprInfo requirePk($key, ConnectionInterface $con = null) Return the ChildGdprInfo by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGdprInfo requireOne(ConnectionInterface $con = null) Return the first ChildGdprInfo matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGdprInfo requireOneById(int $gdpr_info_id) Return the first ChildGdprInfo filtered by the gdpr_info_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGdprInfo requireOneByAbout(string $gdpr_info_About) Return the first ChildGdprInfo filtered by the gdpr_info_About column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGdprInfo requireOneByName(string $gdpr_info_Name) Return the first ChildGdprInfo filtered by the gdpr_info_Name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGdprInfo requireOneByTypeId(int $gdpr_info_Type) Return the first ChildGdprInfo filtered by the gdpr_info_Type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGdprInfo requireOneByComment(string $gdpr_info_comment) Return the first ChildGdprInfo filtered by the gdpr_info_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGdprInfo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGdprInfo objects based on current ModelCriteria
 * @method     ChildGdprInfo[]|ObjectCollection findById(int $gdpr_info_id) Return ChildGdprInfo objects filtered by the gdpr_info_id column
 * @method     ChildGdprInfo[]|ObjectCollection findByAbout(string $gdpr_info_About) Return ChildGdprInfo objects filtered by the gdpr_info_About column
 * @method     ChildGdprInfo[]|ObjectCollection findByName(string $gdpr_info_Name) Return ChildGdprInfo objects filtered by the gdpr_info_Name column
 * @method     ChildGdprInfo[]|ObjectCollection findByTypeId(int $gdpr_info_Type) Return ChildGdprInfo objects filtered by the gdpr_info_Type column
 * @method     ChildGdprInfo[]|ObjectCollection findByComment(string $gdpr_info_comment) Return ChildGdprInfo objects filtered by the gdpr_info_comment column
 * @method     ChildGdprInfo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GdprInfoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\GdprInfoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\GdprInfo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGdprInfoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGdprInfoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGdprInfoQuery) {
            return $criteria;
        }
        $query = new ChildGdprInfoQuery();
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
     * @return ChildGdprInfo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GdprInfoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GdprInfoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGdprInfo A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT gdpr_info_id, gdpr_info_About, gdpr_info_Name, gdpr_info_Type, gdpr_info_comment FROM gdpr_infos WHERE gdpr_info_id = :p0';
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
            /** @var ChildGdprInfo $obj */
            $obj = new ChildGdprInfo();
            $obj->hydrate($row);
            GdprInfoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGdprInfo|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGdprInfoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGdprInfoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the gdpr_info_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE gdpr_info_id = 1234
     * $query->filterById(array(12, 34)); // WHERE gdpr_info_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE gdpr_info_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGdprInfoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_ID, $id, $comparison);
    }

    /**
     * Filter the query on the gdpr_info_About column
     *
     * Example usage:
     * <code>
     * $query->filterByAbout('fooValue');   // WHERE gdpr_info_About = 'fooValue'
     * $query->filterByAbout('%fooValue%', Criteria::LIKE); // WHERE gdpr_info_About LIKE '%fooValue%'
     * </code>
     *
     * @param     string $about The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGdprInfoQuery The current query, for fluid interface
     */
    public function filterByAbout($about = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($about)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_ABOUT, $about, $comparison);
    }

    /**
     * Filter the query on the gdpr_info_Name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE gdpr_info_Name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE gdpr_info_Name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGdprInfoQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the gdpr_info_Type column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeId(1234); // WHERE gdpr_info_Type = 1234
     * $query->filterByTypeId(array(12, 34)); // WHERE gdpr_info_Type IN (12, 34)
     * $query->filterByTypeId(array('min' => 12)); // WHERE gdpr_info_Type > 12
     * </code>
     *
     * @param     mixed $typeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGdprInfoQuery The current query, for fluid interface
     */
    public function filterByTypeId($typeId = null, $comparison = null)
    {
        if (is_array($typeId)) {
            $useMinMax = false;
            if (isset($typeId['min'])) {
                $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_TYPE, $typeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typeId['max'])) {
                $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_TYPE, $typeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_TYPE, $typeId, $comparison);
    }

    /**
     * Filter the query on the gdpr_info_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE gdpr_info_comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE gdpr_info_comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comment The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGdprInfoQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_COMMENT, $comment, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGdprInfo $gdprInfo Object to remove from the list of results
     *
     * @return $this|ChildGdprInfoQuery The current query, for fluid interface
     */
    public function prune($gdprInfo = null)
    {
        if ($gdprInfo) {
            $this->addUsingAlias(GdprInfoTableMap::COL_GDPR_INFO_ID, $gdprInfo->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the gdpr_infos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GdprInfoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GdprInfoTableMap::clearInstancePool();
            GdprInfoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GdprInfoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GdprInfoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GdprInfoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GdprInfoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GdprInfoQuery
