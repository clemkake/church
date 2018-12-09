<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\PastoralCareType as ChildPastoralCareType;
use EcclesiaCRM\PastoralCareTypeQuery as ChildPastoralCareTypeQuery;
use EcclesiaCRM\Map\PastoralCareTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pastoral_care_type' table.
 *
 *
 *
 * @method     ChildPastoralCareTypeQuery orderById($order = Criteria::ASC) Order by the pst_cr_tp_id column
 * @method     ChildPastoralCareTypeQuery orderByTitle($order = Criteria::ASC) Order by the pst_cr_tp_title column
 * @method     ChildPastoralCareTypeQuery orderByDesc($order = Criteria::ASC) Order by the pst_cr_tp_desc column
 * @method     ChildPastoralCareTypeQuery orderByVisible($order = Criteria::ASC) Order by the pst_cr_tp_visible column
 * @method     ChildPastoralCareTypeQuery orderByComment($order = Criteria::ASC) Order by the pst_cr_tp_comment column
 *
 * @method     ChildPastoralCareTypeQuery groupById() Group by the pst_cr_tp_id column
 * @method     ChildPastoralCareTypeQuery groupByTitle() Group by the pst_cr_tp_title column
 * @method     ChildPastoralCareTypeQuery groupByDesc() Group by the pst_cr_tp_desc column
 * @method     ChildPastoralCareTypeQuery groupByVisible() Group by the pst_cr_tp_visible column
 * @method     ChildPastoralCareTypeQuery groupByComment() Group by the pst_cr_tp_comment column
 *
 * @method     ChildPastoralCareTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPastoralCareTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPastoralCareTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPastoralCareTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPastoralCareTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPastoralCareTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPastoralCareTypeQuery leftJoinPastoralCare($relationAlias = null) Adds a LEFT JOIN clause to the query using the PastoralCare relation
 * @method     ChildPastoralCareTypeQuery rightJoinPastoralCare($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PastoralCare relation
 * @method     ChildPastoralCareTypeQuery innerJoinPastoralCare($relationAlias = null) Adds a INNER JOIN clause to the query using the PastoralCare relation
 *
 * @method     ChildPastoralCareTypeQuery joinWithPastoralCare($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PastoralCare relation
 *
 * @method     ChildPastoralCareTypeQuery leftJoinWithPastoralCare() Adds a LEFT JOIN clause and with to the query using the PastoralCare relation
 * @method     ChildPastoralCareTypeQuery rightJoinWithPastoralCare() Adds a RIGHT JOIN clause and with to the query using the PastoralCare relation
 * @method     ChildPastoralCareTypeQuery innerJoinWithPastoralCare() Adds a INNER JOIN clause and with to the query using the PastoralCare relation
 *
 * @method     \EcclesiaCRM\PastoralCareQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPastoralCareType findOne(ConnectionInterface $con = null) Return the first ChildPastoralCareType matching the query
 * @method     ChildPastoralCareType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPastoralCareType matching the query, or a new ChildPastoralCareType object populated from the query conditions when no match is found
 *
 * @method     ChildPastoralCareType findOneById(int $pst_cr_tp_id) Return the first ChildPastoralCareType filtered by the pst_cr_tp_id column
 * @method     ChildPastoralCareType findOneByTitle(string $pst_cr_tp_title) Return the first ChildPastoralCareType filtered by the pst_cr_tp_title column
 * @method     ChildPastoralCareType findOneByDesc(string $pst_cr_tp_desc) Return the first ChildPastoralCareType filtered by the pst_cr_tp_desc column
 * @method     ChildPastoralCareType findOneByVisible(boolean $pst_cr_tp_visible) Return the first ChildPastoralCareType filtered by the pst_cr_tp_visible column
 * @method     ChildPastoralCareType findOneByComment(string $pst_cr_tp_comment) Return the first ChildPastoralCareType filtered by the pst_cr_tp_comment column *

 * @method     ChildPastoralCareType requirePk($key, ConnectionInterface $con = null) Return the ChildPastoralCareType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCareType requireOne(ConnectionInterface $con = null) Return the first ChildPastoralCareType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPastoralCareType requireOneById(int $pst_cr_tp_id) Return the first ChildPastoralCareType filtered by the pst_cr_tp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCareType requireOneByTitle(string $pst_cr_tp_title) Return the first ChildPastoralCareType filtered by the pst_cr_tp_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCareType requireOneByDesc(string $pst_cr_tp_desc) Return the first ChildPastoralCareType filtered by the pst_cr_tp_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCareType requireOneByVisible(boolean $pst_cr_tp_visible) Return the first ChildPastoralCareType filtered by the pst_cr_tp_visible column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCareType requireOneByComment(string $pst_cr_tp_comment) Return the first ChildPastoralCareType filtered by the pst_cr_tp_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPastoralCareType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPastoralCareType objects based on current ModelCriteria
 * @method     ChildPastoralCareType[]|ObjectCollection findById(int $pst_cr_tp_id) Return ChildPastoralCareType objects filtered by the pst_cr_tp_id column
 * @method     ChildPastoralCareType[]|ObjectCollection findByTitle(string $pst_cr_tp_title) Return ChildPastoralCareType objects filtered by the pst_cr_tp_title column
 * @method     ChildPastoralCareType[]|ObjectCollection findByDesc(string $pst_cr_tp_desc) Return ChildPastoralCareType objects filtered by the pst_cr_tp_desc column
 * @method     ChildPastoralCareType[]|ObjectCollection findByVisible(boolean $pst_cr_tp_visible) Return ChildPastoralCareType objects filtered by the pst_cr_tp_visible column
 * @method     ChildPastoralCareType[]|ObjectCollection findByComment(string $pst_cr_tp_comment) Return ChildPastoralCareType objects filtered by the pst_cr_tp_comment column
 * @method     ChildPastoralCareType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PastoralCareTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\PastoralCareTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\PastoralCareType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPastoralCareTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPastoralCareTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPastoralCareTypeQuery) {
            return $criteria;
        }
        $query = new ChildPastoralCareTypeQuery();
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
     * @return ChildPastoralCareType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PastoralCareTypeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PastoralCareTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPastoralCareType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT pst_cr_tp_id, pst_cr_tp_title, pst_cr_tp_desc, pst_cr_tp_visible, pst_cr_tp_comment FROM pastoral_care_type WHERE pst_cr_tp_id = :p0';
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
            /** @var ChildPastoralCareType $obj */
            $obj = new ChildPastoralCareType();
            $obj->hydrate($row);
            PastoralCareTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPastoralCareType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pst_cr_tp_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pst_cr_tp_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pst_cr_tp_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pst_cr_tp_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_ID, $id, $comparison);
    }

    /**
     * Filter the query on the pst_cr_tp_title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE pst_cr_tp_title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE pst_cr_tp_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the pst_cr_tp_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByDesc('fooValue');   // WHERE pst_cr_tp_desc = 'fooValue'
     * $query->filterByDesc('%fooValue%', Criteria::LIKE); // WHERE pst_cr_tp_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $desc The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function filterByDesc($desc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($desc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_DESC, $desc, $comparison);
    }

    /**
     * Filter the query on the pst_cr_tp_visible column
     *
     * Example usage:
     * <code>
     * $query->filterByVisible(true); // WHERE pst_cr_tp_visible = true
     * $query->filterByVisible('yes'); // WHERE pst_cr_tp_visible = true
     * </code>
     *
     * @param     boolean|string $visible The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function filterByVisible($visible = null, $comparison = null)
    {
        if (is_string($visible)) {
            $visible = in_array(strtolower($visible), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_VISIBLE, $visible, $comparison);
    }

    /**
     * Filter the query on the pst_cr_tp_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE pst_cr_tp_comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE pst_cr_tp_comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comment The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_COMMENT, $comment, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\PastoralCare object
     *
     * @param \EcclesiaCRM\PastoralCare|ObjectCollection $pastoralCare the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function filterByPastoralCare($pastoralCare, $comparison = null)
    {
        if ($pastoralCare instanceof \EcclesiaCRM\PastoralCare) {
            return $this
                ->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_ID, $pastoralCare->getTypeId(), $comparison);
        } elseif ($pastoralCare instanceof ObjectCollection) {
            return $this
                ->usePastoralCareQuery()
                ->filterByPrimaryKeys($pastoralCare->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPastoralCare() only accepts arguments of type \EcclesiaCRM\PastoralCare or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PastoralCare relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function joinPastoralCare($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PastoralCare');

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
            $this->addJoinObject($join, 'PastoralCare');
        }

        return $this;
    }

    /**
     * Use the PastoralCare relation PastoralCare object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\PastoralCareQuery A secondary query class using the current class as primary query
     */
    public function usePastoralCareQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPastoralCare($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PastoralCare', '\EcclesiaCRM\PastoralCareQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPastoralCareType $pastoralCareType Object to remove from the list of results
     *
     * @return $this|ChildPastoralCareTypeQuery The current query, for fluid interface
     */
    public function prune($pastoralCareType = null)
    {
        if ($pastoralCareType) {
            $this->addUsingAlias(PastoralCareTypeTableMap::COL_PST_CR_TP_ID, $pastoralCareType->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pastoral_care_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PastoralCareTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PastoralCareTypeTableMap::clearInstancePool();
            PastoralCareTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PastoralCareTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PastoralCareTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PastoralCareTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PastoralCareTypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PastoralCareTypeQuery
