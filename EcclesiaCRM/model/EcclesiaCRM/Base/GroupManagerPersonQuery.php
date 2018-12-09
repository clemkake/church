<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\GroupManagerPerson as ChildGroupManagerPerson;
use EcclesiaCRM\GroupManagerPersonQuery as ChildGroupManagerPersonQuery;
use EcclesiaCRM\Map\GroupManagerPersonTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'group_manager_person' table.
 *
 *
 *
 * @method     ChildGroupManagerPersonQuery orderById($order = Criteria::ASC) Order by the grp_mgr_per_id column
 * @method     ChildGroupManagerPersonQuery orderByPersonId($order = Criteria::ASC) Order by the grp_mgr_per_person_ID column
 * @method     ChildGroupManagerPersonQuery orderByGroupId($order = Criteria::ASC) Order by the grp_mgr_per_group_ID column
 *
 * @method     ChildGroupManagerPersonQuery groupById() Group by the grp_mgr_per_id column
 * @method     ChildGroupManagerPersonQuery groupByPersonId() Group by the grp_mgr_per_person_ID column
 * @method     ChildGroupManagerPersonQuery groupByGroupId() Group by the grp_mgr_per_group_ID column
 *
 * @method     ChildGroupManagerPersonQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGroupManagerPersonQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGroupManagerPersonQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGroupManagerPersonQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGroupManagerPersonQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGroupManagerPersonQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGroupManagerPersonQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     ChildGroupManagerPersonQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     ChildGroupManagerPersonQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     ChildGroupManagerPersonQuery joinWithGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Group relation
 *
 * @method     ChildGroupManagerPersonQuery leftJoinWithGroup() Adds a LEFT JOIN clause and with to the query using the Group relation
 * @method     ChildGroupManagerPersonQuery rightJoinWithGroup() Adds a RIGHT JOIN clause and with to the query using the Group relation
 * @method     ChildGroupManagerPersonQuery innerJoinWithGroup() Adds a INNER JOIN clause and with to the query using the Group relation
 *
 * @method     ChildGroupManagerPersonQuery leftJoinPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the Person relation
 * @method     ChildGroupManagerPersonQuery rightJoinPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Person relation
 * @method     ChildGroupManagerPersonQuery innerJoinPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the Person relation
 *
 * @method     ChildGroupManagerPersonQuery joinWithPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Person relation
 *
 * @method     ChildGroupManagerPersonQuery leftJoinWithPerson() Adds a LEFT JOIN clause and with to the query using the Person relation
 * @method     ChildGroupManagerPersonQuery rightJoinWithPerson() Adds a RIGHT JOIN clause and with to the query using the Person relation
 * @method     ChildGroupManagerPersonQuery innerJoinWithPerson() Adds a INNER JOIN clause and with to the query using the Person relation
 *
 * @method     \EcclesiaCRM\GroupQuery|\EcclesiaCRM\PersonQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGroupManagerPerson findOne(ConnectionInterface $con = null) Return the first ChildGroupManagerPerson matching the query
 * @method     ChildGroupManagerPerson findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGroupManagerPerson matching the query, or a new ChildGroupManagerPerson object populated from the query conditions when no match is found
 *
 * @method     ChildGroupManagerPerson findOneById(int $grp_mgr_per_id) Return the first ChildGroupManagerPerson filtered by the grp_mgr_per_id column
 * @method     ChildGroupManagerPerson findOneByPersonId(int $grp_mgr_per_person_ID) Return the first ChildGroupManagerPerson filtered by the grp_mgr_per_person_ID column
 * @method     ChildGroupManagerPerson findOneByGroupId(int $grp_mgr_per_group_ID) Return the first ChildGroupManagerPerson filtered by the grp_mgr_per_group_ID column *

 * @method     ChildGroupManagerPerson requirePk($key, ConnectionInterface $con = null) Return the ChildGroupManagerPerson by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupManagerPerson requireOne(ConnectionInterface $con = null) Return the first ChildGroupManagerPerson matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroupManagerPerson requireOneById(int $grp_mgr_per_id) Return the first ChildGroupManagerPerson filtered by the grp_mgr_per_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupManagerPerson requireOneByPersonId(int $grp_mgr_per_person_ID) Return the first ChildGroupManagerPerson filtered by the grp_mgr_per_person_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupManagerPerson requireOneByGroupId(int $grp_mgr_per_group_ID) Return the first ChildGroupManagerPerson filtered by the grp_mgr_per_group_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroupManagerPerson[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGroupManagerPerson objects based on current ModelCriteria
 * @method     ChildGroupManagerPerson[]|ObjectCollection findById(int $grp_mgr_per_id) Return ChildGroupManagerPerson objects filtered by the grp_mgr_per_id column
 * @method     ChildGroupManagerPerson[]|ObjectCollection findByPersonId(int $grp_mgr_per_person_ID) Return ChildGroupManagerPerson objects filtered by the grp_mgr_per_person_ID column
 * @method     ChildGroupManagerPerson[]|ObjectCollection findByGroupId(int $grp_mgr_per_group_ID) Return ChildGroupManagerPerson objects filtered by the grp_mgr_per_group_ID column
 * @method     ChildGroupManagerPerson[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GroupManagerPersonQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\GroupManagerPersonQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\GroupManagerPerson', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGroupManagerPersonQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGroupManagerPersonQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGroupManagerPersonQuery) {
            return $criteria;
        }
        $query = new ChildGroupManagerPersonQuery();
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
     * @return ChildGroupManagerPerson|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GroupManagerPersonTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GroupManagerPersonTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGroupManagerPerson A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT grp_mgr_per_id, grp_mgr_per_person_ID, grp_mgr_per_group_ID FROM group_manager_person WHERE grp_mgr_per_id = :p0';
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
            /** @var ChildGroupManagerPerson $obj */
            $obj = new ChildGroupManagerPerson();
            $obj->hydrate($row);
            GroupManagerPersonTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGroupManagerPerson|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the grp_mgr_per_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE grp_mgr_per_id = 1234
     * $query->filterById(array(12, 34)); // WHERE grp_mgr_per_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE grp_mgr_per_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_ID, $id, $comparison);
    }

    /**
     * Filter the query on the grp_mgr_per_person_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonId(1234); // WHERE grp_mgr_per_person_ID = 1234
     * $query->filterByPersonId(array(12, 34)); // WHERE grp_mgr_per_person_ID IN (12, 34)
     * $query->filterByPersonId(array('min' => 12)); // WHERE grp_mgr_per_person_ID > 12
     * </code>
     *
     * @see       filterByPerson()
     *
     * @param     mixed $personId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function filterByPersonId($personId = null, $comparison = null)
    {
        if (is_array($personId)) {
            $useMinMax = false;
            if (isset($personId['min'])) {
                $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_PERSON_ID, $personId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personId['max'])) {
                $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_PERSON_ID, $personId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_PERSON_ID, $personId, $comparison);
    }

    /**
     * Filter the query on the grp_mgr_per_group_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupId(1234); // WHERE grp_mgr_per_group_ID = 1234
     * $query->filterByGroupId(array(12, 34)); // WHERE grp_mgr_per_group_ID IN (12, 34)
     * $query->filterByGroupId(array('min' => 12)); // WHERE grp_mgr_per_group_ID > 12
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
     * @return $this|ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function filterByGroupId($groupId = null, $comparison = null)
    {
        if (is_array($groupId)) {
            $useMinMax = false;
            if (isset($groupId['min'])) {
                $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_GROUP_ID, $groupId, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Group object
     *
     * @param \EcclesiaCRM\Group|ObjectCollection $group The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof \EcclesiaCRM\Group) {
            return $this
                ->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_GROUP_ID, $group->getId(), $comparison);
        } elseif ($group instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_GROUP_ID, $group->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function joinGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Group', '\EcclesiaCRM\GroupQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Person object
     *
     * @param \EcclesiaCRM\Person|ObjectCollection $person The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function filterByPerson($person, $comparison = null)
    {
        if ($person instanceof \EcclesiaCRM\Person) {
            return $this
                ->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_PERSON_ID, $person->getId(), $comparison);
        } elseif ($person instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_PERSON_ID, $person->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPerson() only accepts arguments of type \EcclesiaCRM\Person or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Person relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function joinPerson($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Person');

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
            $this->addJoinObject($join, 'Person');
        }

        return $this;
    }

    /**
     * Use the Person relation Person object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\PersonQuery A secondary query class using the current class as primary query
     */
    public function usePersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Person', '\EcclesiaCRM\PersonQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGroupManagerPerson $groupManagerPerson Object to remove from the list of results
     *
     * @return $this|ChildGroupManagerPersonQuery The current query, for fluid interface
     */
    public function prune($groupManagerPerson = null)
    {
        if ($groupManagerPerson) {
            $this->addUsingAlias(GroupManagerPersonTableMap::COL_GRP_MGR_PER_ID, $groupManagerPerson->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the group_manager_person table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupManagerPersonTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GroupManagerPersonTableMap::clearInstancePool();
            GroupManagerPersonTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GroupManagerPersonTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GroupManagerPersonTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GroupManagerPersonTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GroupManagerPersonTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GroupManagerPersonQuery
