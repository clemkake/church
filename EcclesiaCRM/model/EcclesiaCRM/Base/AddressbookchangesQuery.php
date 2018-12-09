<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Addressbookchanges as ChildAddressbookchanges;
use EcclesiaCRM\AddressbookchangesQuery as ChildAddressbookchangesQuery;
use EcclesiaCRM\Map\AddressbookchangesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'addressbookchanges' table.
 *
 *
 *
 * @method     ChildAddressbookchangesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAddressbookchangesQuery orderByUri($order = Criteria::ASC) Order by the uri column
 * @method     ChildAddressbookchangesQuery orderBySyncToken($order = Criteria::ASC) Order by the synctoken column
 * @method     ChildAddressbookchangesQuery orderByAddressbookId($order = Criteria::ASC) Order by the addressbookid column
 * @method     ChildAddressbookchangesQuery orderByOperation($order = Criteria::ASC) Order by the operation column
 *
 * @method     ChildAddressbookchangesQuery groupById() Group by the id column
 * @method     ChildAddressbookchangesQuery groupByUri() Group by the uri column
 * @method     ChildAddressbookchangesQuery groupBySyncToken() Group by the synctoken column
 * @method     ChildAddressbookchangesQuery groupByAddressbookId() Group by the addressbookid column
 * @method     ChildAddressbookchangesQuery groupByOperation() Group by the operation column
 *
 * @method     ChildAddressbookchangesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAddressbookchangesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAddressbookchangesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAddressbookchangesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAddressbookchangesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAddressbookchangesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAddressbookchangesQuery leftJoinAddressbooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Addressbooks relation
 * @method     ChildAddressbookchangesQuery rightJoinAddressbooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Addressbooks relation
 * @method     ChildAddressbookchangesQuery innerJoinAddressbooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Addressbooks relation
 *
 * @method     ChildAddressbookchangesQuery joinWithAddressbooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Addressbooks relation
 *
 * @method     ChildAddressbookchangesQuery leftJoinWithAddressbooks() Adds a LEFT JOIN clause and with to the query using the Addressbooks relation
 * @method     ChildAddressbookchangesQuery rightJoinWithAddressbooks() Adds a RIGHT JOIN clause and with to the query using the Addressbooks relation
 * @method     ChildAddressbookchangesQuery innerJoinWithAddressbooks() Adds a INNER JOIN clause and with to the query using the Addressbooks relation
 *
 * @method     \EcclesiaCRM\AddressbooksQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAddressbookchanges findOne(ConnectionInterface $con = null) Return the first ChildAddressbookchanges matching the query
 * @method     ChildAddressbookchanges findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAddressbookchanges matching the query, or a new ChildAddressbookchanges object populated from the query conditions when no match is found
 *
 * @method     ChildAddressbookchanges findOneById(int $id) Return the first ChildAddressbookchanges filtered by the id column
 * @method     ChildAddressbookchanges findOneByUri(string $uri) Return the first ChildAddressbookchanges filtered by the uri column
 * @method     ChildAddressbookchanges findOneBySyncToken(int $synctoken) Return the first ChildAddressbookchanges filtered by the synctoken column
 * @method     ChildAddressbookchanges findOneByAddressbookId(int $addressbookid) Return the first ChildAddressbookchanges filtered by the addressbookid column
 * @method     ChildAddressbookchanges findOneByOperation(boolean $operation) Return the first ChildAddressbookchanges filtered by the operation column *

 * @method     ChildAddressbookchanges requirePk($key, ConnectionInterface $con = null) Return the ChildAddressbookchanges by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbookchanges requireOne(ConnectionInterface $con = null) Return the first ChildAddressbookchanges matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAddressbookchanges requireOneById(int $id) Return the first ChildAddressbookchanges filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbookchanges requireOneByUri(string $uri) Return the first ChildAddressbookchanges filtered by the uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbookchanges requireOneBySyncToken(int $synctoken) Return the first ChildAddressbookchanges filtered by the synctoken column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbookchanges requireOneByAddressbookId(int $addressbookid) Return the first ChildAddressbookchanges filtered by the addressbookid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbookchanges requireOneByOperation(boolean $operation) Return the first ChildAddressbookchanges filtered by the operation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAddressbookchanges[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAddressbookchanges objects based on current ModelCriteria
 * @method     ChildAddressbookchanges[]|ObjectCollection findById(int $id) Return ChildAddressbookchanges objects filtered by the id column
 * @method     ChildAddressbookchanges[]|ObjectCollection findByUri(string $uri) Return ChildAddressbookchanges objects filtered by the uri column
 * @method     ChildAddressbookchanges[]|ObjectCollection findBySyncToken(int $synctoken) Return ChildAddressbookchanges objects filtered by the synctoken column
 * @method     ChildAddressbookchanges[]|ObjectCollection findByAddressbookId(int $addressbookid) Return ChildAddressbookchanges objects filtered by the addressbookid column
 * @method     ChildAddressbookchanges[]|ObjectCollection findByOperation(boolean $operation) Return ChildAddressbookchanges objects filtered by the operation column
 * @method     ChildAddressbookchanges[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AddressbookchangesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\AddressbookchangesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Addressbookchanges', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAddressbookchangesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAddressbookchangesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAddressbookchangesQuery) {
            return $criteria;
        }
        $query = new ChildAddressbookchangesQuery();
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
     * @return ChildAddressbookchanges|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AddressbookchangesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AddressbookchangesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAddressbookchanges A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, uri, synctoken, addressbookid, operation FROM addressbookchanges WHERE id = :p0';
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
            /** @var ChildAddressbookchanges $obj */
            $obj = new ChildAddressbookchanges();
            $obj->hydrate($row);
            AddressbookchangesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAddressbookchanges|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AddressbookchangesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AddressbookchangesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AddressbookchangesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AddressbookchangesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbookchangesTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbookchangesTableMap::COL_URI, $uri, $comparison);
    }

    /**
     * Filter the query on the synctoken column
     *
     * Example usage:
     * <code>
     * $query->filterBySyncToken(1234); // WHERE synctoken = 1234
     * $query->filterBySyncToken(array(12, 34)); // WHERE synctoken IN (12, 34)
     * $query->filterBySyncToken(array('min' => 12)); // WHERE synctoken > 12
     * </code>
     *
     * @param     mixed $syncToken The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function filterBySyncToken($syncToken = null, $comparison = null)
    {
        if (is_array($syncToken)) {
            $useMinMax = false;
            if (isset($syncToken['min'])) {
                $this->addUsingAlias(AddressbookchangesTableMap::COL_SYNCTOKEN, $syncToken['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($syncToken['max'])) {
                $this->addUsingAlias(AddressbookchangesTableMap::COL_SYNCTOKEN, $syncToken['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbookchangesTableMap::COL_SYNCTOKEN, $syncToken, $comparison);
    }

    /**
     * Filter the query on the addressbookid column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressbookId(1234); // WHERE addressbookid = 1234
     * $query->filterByAddressbookId(array(12, 34)); // WHERE addressbookid IN (12, 34)
     * $query->filterByAddressbookId(array('min' => 12)); // WHERE addressbookid > 12
     * </code>
     *
     * @see       filterByAddressbooks()
     *
     * @param     mixed $addressbookId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function filterByAddressbookId($addressbookId = null, $comparison = null)
    {
        if (is_array($addressbookId)) {
            $useMinMax = false;
            if (isset($addressbookId['min'])) {
                $this->addUsingAlias(AddressbookchangesTableMap::COL_ADDRESSBOOKID, $addressbookId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addressbookId['max'])) {
                $this->addUsingAlias(AddressbookchangesTableMap::COL_ADDRESSBOOKID, $addressbookId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbookchangesTableMap::COL_ADDRESSBOOKID, $addressbookId, $comparison);
    }

    /**
     * Filter the query on the operation column
     *
     * Example usage:
     * <code>
     * $query->filterByOperation(true); // WHERE operation = true
     * $query->filterByOperation('yes'); // WHERE operation = true
     * </code>
     *
     * @param     boolean|string $operation The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function filterByOperation($operation = null, $comparison = null)
    {
        if (is_string($operation)) {
            $operation = in_array(strtolower($operation), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AddressbookchangesTableMap::COL_OPERATION, $operation, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Addressbooks object
     *
     * @param \EcclesiaCRM\Addressbooks|ObjectCollection $addressbooks The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function filterByAddressbooks($addressbooks, $comparison = null)
    {
        if ($addressbooks instanceof \EcclesiaCRM\Addressbooks) {
            return $this
                ->addUsingAlias(AddressbookchangesTableMap::COL_ADDRESSBOOKID, $addressbooks->getId(), $comparison);
        } elseif ($addressbooks instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AddressbookchangesTableMap::COL_ADDRESSBOOKID, $addressbooks->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAddressbooks() only accepts arguments of type \EcclesiaCRM\Addressbooks or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Addressbooks relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function joinAddressbooks($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Addressbooks');

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
            $this->addJoinObject($join, 'Addressbooks');
        }

        return $this;
    }

    /**
     * Use the Addressbooks relation Addressbooks object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\AddressbooksQuery A secondary query class using the current class as primary query
     */
    public function useAddressbooksQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAddressbooks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Addressbooks', '\EcclesiaCRM\AddressbooksQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAddressbookchanges $addressbookchanges Object to remove from the list of results
     *
     * @return $this|ChildAddressbookchangesQuery The current query, for fluid interface
     */
    public function prune($addressbookchanges = null)
    {
        if ($addressbookchanges) {
            $this->addUsingAlias(AddressbookchangesTableMap::COL_ID, $addressbookchanges->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the addressbookchanges table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AddressbookchangesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AddressbookchangesTableMap::clearInstancePool();
            AddressbookchangesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AddressbookchangesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AddressbookchangesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AddressbookchangesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AddressbookchangesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AddressbookchangesQuery
