<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Addressbooks as ChildAddressbooks;
use EcclesiaCRM\AddressbooksQuery as ChildAddressbooksQuery;
use EcclesiaCRM\Map\AddressbooksTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'addressbooks' table.
 *
 *
 *
 * @method     ChildAddressbooksQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAddressbooksQuery orderByPrincipalUri($order = Criteria::ASC) Order by the principaluri column
 * @method     ChildAddressbooksQuery orderByDisplayName($order = Criteria::ASC) Order by the displayname column
 * @method     ChildAddressbooksQuery orderByUri($order = Criteria::ASC) Order by the uri column
 * @method     ChildAddressbooksQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildAddressbooksQuery orderBySynctoken($order = Criteria::ASC) Order by the synctoken column
 *
 * @method     ChildAddressbooksQuery groupById() Group by the id column
 * @method     ChildAddressbooksQuery groupByPrincipalUri() Group by the principaluri column
 * @method     ChildAddressbooksQuery groupByDisplayName() Group by the displayname column
 * @method     ChildAddressbooksQuery groupByUri() Group by the uri column
 * @method     ChildAddressbooksQuery groupByDescription() Group by the description column
 * @method     ChildAddressbooksQuery groupBySynctoken() Group by the synctoken column
 *
 * @method     ChildAddressbooksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAddressbooksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAddressbooksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAddressbooksQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAddressbooksQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAddressbooksQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAddressbooksQuery leftJoinAddressbookchanges($relationAlias = null) Adds a LEFT JOIN clause to the query using the Addressbookchanges relation
 * @method     ChildAddressbooksQuery rightJoinAddressbookchanges($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Addressbookchanges relation
 * @method     ChildAddressbooksQuery innerJoinAddressbookchanges($relationAlias = null) Adds a INNER JOIN clause to the query using the Addressbookchanges relation
 *
 * @method     ChildAddressbooksQuery joinWithAddressbookchanges($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Addressbookchanges relation
 *
 * @method     ChildAddressbooksQuery leftJoinWithAddressbookchanges() Adds a LEFT JOIN clause and with to the query using the Addressbookchanges relation
 * @method     ChildAddressbooksQuery rightJoinWithAddressbookchanges() Adds a RIGHT JOIN clause and with to the query using the Addressbookchanges relation
 * @method     ChildAddressbooksQuery innerJoinWithAddressbookchanges() Adds a INNER JOIN clause and with to the query using the Addressbookchanges relation
 *
 * @method     ChildAddressbooksQuery leftJoinCards($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cards relation
 * @method     ChildAddressbooksQuery rightJoinCards($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cards relation
 * @method     ChildAddressbooksQuery innerJoinCards($relationAlias = null) Adds a INNER JOIN clause to the query using the Cards relation
 *
 * @method     ChildAddressbooksQuery joinWithCards($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cards relation
 *
 * @method     ChildAddressbooksQuery leftJoinWithCards() Adds a LEFT JOIN clause and with to the query using the Cards relation
 * @method     ChildAddressbooksQuery rightJoinWithCards() Adds a RIGHT JOIN clause and with to the query using the Cards relation
 * @method     ChildAddressbooksQuery innerJoinWithCards() Adds a INNER JOIN clause and with to the query using the Cards relation
 *
 * @method     \EcclesiaCRM\AddressbookchangesQuery|\EcclesiaCRM\CardsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAddressbooks findOne(ConnectionInterface $con = null) Return the first ChildAddressbooks matching the query
 * @method     ChildAddressbooks findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAddressbooks matching the query, or a new ChildAddressbooks object populated from the query conditions when no match is found
 *
 * @method     ChildAddressbooks findOneById(int $id) Return the first ChildAddressbooks filtered by the id column
 * @method     ChildAddressbooks findOneByPrincipalUri(string $principaluri) Return the first ChildAddressbooks filtered by the principaluri column
 * @method     ChildAddressbooks findOneByDisplayName(string $displayname) Return the first ChildAddressbooks filtered by the displayname column
 * @method     ChildAddressbooks findOneByUri(string $uri) Return the first ChildAddressbooks filtered by the uri column
 * @method     ChildAddressbooks findOneByDescription(string $description) Return the first ChildAddressbooks filtered by the description column
 * @method     ChildAddressbooks findOneBySynctoken(int $synctoken) Return the first ChildAddressbooks filtered by the synctoken column *

 * @method     ChildAddressbooks requirePk($key, ConnectionInterface $con = null) Return the ChildAddressbooks by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbooks requireOne(ConnectionInterface $con = null) Return the first ChildAddressbooks matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAddressbooks requireOneById(int $id) Return the first ChildAddressbooks filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbooks requireOneByPrincipalUri(string $principaluri) Return the first ChildAddressbooks filtered by the principaluri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbooks requireOneByDisplayName(string $displayname) Return the first ChildAddressbooks filtered by the displayname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbooks requireOneByUri(string $uri) Return the first ChildAddressbooks filtered by the uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbooks requireOneByDescription(string $description) Return the first ChildAddressbooks filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddressbooks requireOneBySynctoken(int $synctoken) Return the first ChildAddressbooks filtered by the synctoken column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAddressbooks[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAddressbooks objects based on current ModelCriteria
 * @method     ChildAddressbooks[]|ObjectCollection findById(int $id) Return ChildAddressbooks objects filtered by the id column
 * @method     ChildAddressbooks[]|ObjectCollection findByPrincipalUri(string $principaluri) Return ChildAddressbooks objects filtered by the principaluri column
 * @method     ChildAddressbooks[]|ObjectCollection findByDisplayName(string $displayname) Return ChildAddressbooks objects filtered by the displayname column
 * @method     ChildAddressbooks[]|ObjectCollection findByUri(string $uri) Return ChildAddressbooks objects filtered by the uri column
 * @method     ChildAddressbooks[]|ObjectCollection findByDescription(string $description) Return ChildAddressbooks objects filtered by the description column
 * @method     ChildAddressbooks[]|ObjectCollection findBySynctoken(int $synctoken) Return ChildAddressbooks objects filtered by the synctoken column
 * @method     ChildAddressbooks[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AddressbooksQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\AddressbooksQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Addressbooks', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAddressbooksQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAddressbooksQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAddressbooksQuery) {
            return $criteria;
        }
        $query = new ChildAddressbooksQuery();
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
     * @return ChildAddressbooks|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AddressbooksTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AddressbooksTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAddressbooks A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, principaluri, displayname, uri, description, synctoken FROM addressbooks WHERE id = :p0';
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
            /** @var ChildAddressbooks $obj */
            $obj = new ChildAddressbooks();
            $obj->hydrate($row);
            AddressbooksTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAddressbooks|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AddressbooksTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AddressbooksTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AddressbooksTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AddressbooksTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbooksTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the principaluri column
     *
     * Example usage:
     * <code>
     * $query->filterByPrincipalUri('fooValue');   // WHERE principaluri = 'fooValue'
     * $query->filterByPrincipalUri('%fooValue%', Criteria::LIKE); // WHERE principaluri LIKE '%fooValue%'
     * </code>
     *
     * @param     string $principalUri The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterByPrincipalUri($principalUri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($principalUri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbooksTableMap::COL_PRINCIPALURI, $principalUri, $comparison);
    }

    /**
     * Filter the query on the displayname column
     *
     * Example usage:
     * <code>
     * $query->filterByDisplayName('fooValue');   // WHERE displayname = 'fooValue'
     * $query->filterByDisplayName('%fooValue%', Criteria::LIKE); // WHERE displayname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $displayName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterByDisplayName($displayName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($displayName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbooksTableMap::COL_DISPLAYNAME, $displayName, $comparison);
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
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbooksTableMap::COL_URI, $uri, $comparison);
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
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbooksTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterBySynctoken($synctoken = null, $comparison = null)
    {
        if (is_array($synctoken)) {
            $useMinMax = false;
            if (isset($synctoken['min'])) {
                $this->addUsingAlias(AddressbooksTableMap::COL_SYNCTOKEN, $synctoken['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($synctoken['max'])) {
                $this->addUsingAlias(AddressbooksTableMap::COL_SYNCTOKEN, $synctoken['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressbooksTableMap::COL_SYNCTOKEN, $synctoken, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Addressbookchanges object
     *
     * @param \EcclesiaCRM\Addressbookchanges|ObjectCollection $addressbookchanges the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterByAddressbookchanges($addressbookchanges, $comparison = null)
    {
        if ($addressbookchanges instanceof \EcclesiaCRM\Addressbookchanges) {
            return $this
                ->addUsingAlias(AddressbooksTableMap::COL_ID, $addressbookchanges->getAddressbookId(), $comparison);
        } elseif ($addressbookchanges instanceof ObjectCollection) {
            return $this
                ->useAddressbookchangesQuery()
                ->filterByPrimaryKeys($addressbookchanges->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAddressbookchanges() only accepts arguments of type \EcclesiaCRM\Addressbookchanges or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Addressbookchanges relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function joinAddressbookchanges($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Addressbookchanges');

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
            $this->addJoinObject($join, 'Addressbookchanges');
        }

        return $this;
    }

    /**
     * Use the Addressbookchanges relation Addressbookchanges object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\AddressbookchangesQuery A secondary query class using the current class as primary query
     */
    public function useAddressbookchangesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAddressbookchanges($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Addressbookchanges', '\EcclesiaCRM\AddressbookchangesQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Cards object
     *
     * @param \EcclesiaCRM\Cards|ObjectCollection $cards the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAddressbooksQuery The current query, for fluid interface
     */
    public function filterByCards($cards, $comparison = null)
    {
        if ($cards instanceof \EcclesiaCRM\Cards) {
            return $this
                ->addUsingAlias(AddressbooksTableMap::COL_ID, $cards->getAddressbookid(), $comparison);
        } elseif ($cards instanceof ObjectCollection) {
            return $this
                ->useCardsQuery()
                ->filterByPrimaryKeys($cards->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCards() only accepts arguments of type \EcclesiaCRM\Cards or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cards relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function joinCards($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cards');

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
            $this->addJoinObject($join, 'Cards');
        }

        return $this;
    }

    /**
     * Use the Cards relation Cards object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\CardsQuery A secondary query class using the current class as primary query
     */
    public function useCardsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCards($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cards', '\EcclesiaCRM\CardsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAddressbooks $addressbooks Object to remove from the list of results
     *
     * @return $this|ChildAddressbooksQuery The current query, for fluid interface
     */
    public function prune($addressbooks = null)
    {
        if ($addressbooks) {
            $this->addUsingAlias(AddressbooksTableMap::COL_ID, $addressbooks->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the addressbooks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AddressbooksTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AddressbooksTableMap::clearInstancePool();
            AddressbooksTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AddressbooksTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AddressbooksTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AddressbooksTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AddressbooksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AddressbooksQuery
