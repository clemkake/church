<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\NoteShare as ChildNoteShare;
use EcclesiaCRM\NoteShareQuery as ChildNoteShareQuery;
use EcclesiaCRM\Map\NoteShareTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'note_nte_share' table.
 *
 *
 *
 * @method     ChildNoteShareQuery orderById($order = Criteria::ASC) Order by the nte_sh_id column
 * @method     ChildNoteShareQuery orderByNoteId($order = Criteria::ASC) Order by the nte_sh_note_ID column
 * @method     ChildNoteShareQuery orderBySharePerId($order = Criteria::ASC) Order by the nte_sh_share_to_person_ID column
 * @method     ChildNoteShareQuery orderByShareFamId($order = Criteria::ASC) Order by the nte_sh_share_to_family_ID column
 * @method     ChildNoteShareQuery orderByRights($order = Criteria::ASC) Order by the nte_sh_share_rights column
 *
 * @method     ChildNoteShareQuery groupById() Group by the nte_sh_id column
 * @method     ChildNoteShareQuery groupByNoteId() Group by the nte_sh_note_ID column
 * @method     ChildNoteShareQuery groupBySharePerId() Group by the nte_sh_share_to_person_ID column
 * @method     ChildNoteShareQuery groupByShareFamId() Group by the nte_sh_share_to_family_ID column
 * @method     ChildNoteShareQuery groupByRights() Group by the nte_sh_share_rights column
 *
 * @method     ChildNoteShareQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNoteShareQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNoteShareQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNoteShareQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNoteShareQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNoteShareQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNoteShareQuery leftJoinNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the Note relation
 * @method     ChildNoteShareQuery rightJoinNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Note relation
 * @method     ChildNoteShareQuery innerJoinNote($relationAlias = null) Adds a INNER JOIN clause to the query using the Note relation
 *
 * @method     ChildNoteShareQuery joinWithNote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Note relation
 *
 * @method     ChildNoteShareQuery leftJoinWithNote() Adds a LEFT JOIN clause and with to the query using the Note relation
 * @method     ChildNoteShareQuery rightJoinWithNote() Adds a RIGHT JOIN clause and with to the query using the Note relation
 * @method     ChildNoteShareQuery innerJoinWithNote() Adds a INNER JOIN clause and with to the query using the Note relation
 *
 * @method     ChildNoteShareQuery leftJoinFamily($relationAlias = null) Adds a LEFT JOIN clause to the query using the Family relation
 * @method     ChildNoteShareQuery rightJoinFamily($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Family relation
 * @method     ChildNoteShareQuery innerJoinFamily($relationAlias = null) Adds a INNER JOIN clause to the query using the Family relation
 *
 * @method     ChildNoteShareQuery joinWithFamily($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Family relation
 *
 * @method     ChildNoteShareQuery leftJoinWithFamily() Adds a LEFT JOIN clause and with to the query using the Family relation
 * @method     ChildNoteShareQuery rightJoinWithFamily() Adds a RIGHT JOIN clause and with to the query using the Family relation
 * @method     ChildNoteShareQuery innerJoinWithFamily() Adds a INNER JOIN clause and with to the query using the Family relation
 *
 * @method     ChildNoteShareQuery leftJoinPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the Person relation
 * @method     ChildNoteShareQuery rightJoinPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Person relation
 * @method     ChildNoteShareQuery innerJoinPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the Person relation
 *
 * @method     ChildNoteShareQuery joinWithPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Person relation
 *
 * @method     ChildNoteShareQuery leftJoinWithPerson() Adds a LEFT JOIN clause and with to the query using the Person relation
 * @method     ChildNoteShareQuery rightJoinWithPerson() Adds a RIGHT JOIN clause and with to the query using the Person relation
 * @method     ChildNoteShareQuery innerJoinWithPerson() Adds a INNER JOIN clause and with to the query using the Person relation
 *
 * @method     \EcclesiaCRM\NoteQuery|\EcclesiaCRM\FamilyQuery|\EcclesiaCRM\PersonQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildNoteShare findOne(ConnectionInterface $con = null) Return the first ChildNoteShare matching the query
 * @method     ChildNoteShare findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNoteShare matching the query, or a new ChildNoteShare object populated from the query conditions when no match is found
 *
 * @method     ChildNoteShare findOneById(int $nte_sh_id) Return the first ChildNoteShare filtered by the nte_sh_id column
 * @method     ChildNoteShare findOneByNoteId(int $nte_sh_note_ID) Return the first ChildNoteShare filtered by the nte_sh_note_ID column
 * @method     ChildNoteShare findOneBySharePerId(int $nte_sh_share_to_person_ID) Return the first ChildNoteShare filtered by the nte_sh_share_to_person_ID column
 * @method     ChildNoteShare findOneByShareFamId(int $nte_sh_share_to_family_ID) Return the first ChildNoteShare filtered by the nte_sh_share_to_family_ID column
 * @method     ChildNoteShare findOneByRights(int $nte_sh_share_rights) Return the first ChildNoteShare filtered by the nte_sh_share_rights column *

 * @method     ChildNoteShare requirePk($key, ConnectionInterface $con = null) Return the ChildNoteShare by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNoteShare requireOne(ConnectionInterface $con = null) Return the first ChildNoteShare matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNoteShare requireOneById(int $nte_sh_id) Return the first ChildNoteShare filtered by the nte_sh_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNoteShare requireOneByNoteId(int $nte_sh_note_ID) Return the first ChildNoteShare filtered by the nte_sh_note_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNoteShare requireOneBySharePerId(int $nte_sh_share_to_person_ID) Return the first ChildNoteShare filtered by the nte_sh_share_to_person_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNoteShare requireOneByShareFamId(int $nte_sh_share_to_family_ID) Return the first ChildNoteShare filtered by the nte_sh_share_to_family_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNoteShare requireOneByRights(int $nte_sh_share_rights) Return the first ChildNoteShare filtered by the nte_sh_share_rights column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNoteShare[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildNoteShare objects based on current ModelCriteria
 * @method     ChildNoteShare[]|ObjectCollection findById(int $nte_sh_id) Return ChildNoteShare objects filtered by the nte_sh_id column
 * @method     ChildNoteShare[]|ObjectCollection findByNoteId(int $nte_sh_note_ID) Return ChildNoteShare objects filtered by the nte_sh_note_ID column
 * @method     ChildNoteShare[]|ObjectCollection findBySharePerId(int $nte_sh_share_to_person_ID) Return ChildNoteShare objects filtered by the nte_sh_share_to_person_ID column
 * @method     ChildNoteShare[]|ObjectCollection findByShareFamId(int $nte_sh_share_to_family_ID) Return ChildNoteShare objects filtered by the nte_sh_share_to_family_ID column
 * @method     ChildNoteShare[]|ObjectCollection findByRights(int $nte_sh_share_rights) Return ChildNoteShare objects filtered by the nte_sh_share_rights column
 * @method     ChildNoteShare[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class NoteShareQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\NoteShareQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\NoteShare', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNoteShareQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNoteShareQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildNoteShareQuery) {
            return $criteria;
        }
        $query = new ChildNoteShareQuery();
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
     * @return ChildNoteShare|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NoteShareTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NoteShareTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildNoteShare A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT nte_sh_id, nte_sh_note_ID, nte_sh_share_to_person_ID, nte_sh_share_to_family_ID, nte_sh_share_rights FROM note_nte_share WHERE nte_sh_id = :p0';
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
            /** @var ChildNoteShare $obj */
            $obj = new ChildNoteShare();
            $obj->hydrate($row);
            NoteShareTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNoteShare|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the nte_sh_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE nte_sh_id = 1234
     * $query->filterById(array(12, 34)); // WHERE nte_sh_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE nte_sh_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_ID, $id, $comparison);
    }

    /**
     * Filter the query on the nte_sh_note_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByNoteId(1234); // WHERE nte_sh_note_ID = 1234
     * $query->filterByNoteId(array(12, 34)); // WHERE nte_sh_note_ID IN (12, 34)
     * $query->filterByNoteId(array('min' => 12)); // WHERE nte_sh_note_ID > 12
     * </code>
     *
     * @see       filterByNote()
     *
     * @param     mixed $noteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterByNoteId($noteId = null, $comparison = null)
    {
        if (is_array($noteId)) {
            $useMinMax = false;
            if (isset($noteId['min'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_NOTE_ID, $noteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($noteId['max'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_NOTE_ID, $noteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_NOTE_ID, $noteId, $comparison);
    }

    /**
     * Filter the query on the nte_sh_share_to_person_ID column
     *
     * Example usage:
     * <code>
     * $query->filterBySharePerId(1234); // WHERE nte_sh_share_to_person_ID = 1234
     * $query->filterBySharePerId(array(12, 34)); // WHERE nte_sh_share_to_person_ID IN (12, 34)
     * $query->filterBySharePerId(array('min' => 12)); // WHERE nte_sh_share_to_person_ID > 12
     * </code>
     *
     * @see       filterByPerson()
     *
     * @param     mixed $sharePerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterBySharePerId($sharePerId = null, $comparison = null)
    {
        if (is_array($sharePerId)) {
            $useMinMax = false;
            if (isset($sharePerId['min'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_PERSON_ID, $sharePerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sharePerId['max'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_PERSON_ID, $sharePerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_PERSON_ID, $sharePerId, $comparison);
    }

    /**
     * Filter the query on the nte_sh_share_to_family_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByShareFamId(1234); // WHERE nte_sh_share_to_family_ID = 1234
     * $query->filterByShareFamId(array(12, 34)); // WHERE nte_sh_share_to_family_ID IN (12, 34)
     * $query->filterByShareFamId(array('min' => 12)); // WHERE nte_sh_share_to_family_ID > 12
     * </code>
     *
     * @see       filterByFamily()
     *
     * @param     mixed $shareFamId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterByShareFamId($shareFamId = null, $comparison = null)
    {
        if (is_array($shareFamId)) {
            $useMinMax = false;
            if (isset($shareFamId['min'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_FAMILY_ID, $shareFamId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shareFamId['max'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_FAMILY_ID, $shareFamId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_FAMILY_ID, $shareFamId, $comparison);
    }

    /**
     * Filter the query on the nte_sh_share_rights column
     *
     * Example usage:
     * <code>
     * $query->filterByRights(1234); // WHERE nte_sh_share_rights = 1234
     * $query->filterByRights(array(12, 34)); // WHERE nte_sh_share_rights IN (12, 34)
     * $query->filterByRights(array('min' => 12)); // WHERE nte_sh_share_rights > 12
     * </code>
     *
     * @param     mixed $rights The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterByRights($rights = null, $comparison = null)
    {
        if (is_array($rights)) {
            $useMinMax = false;
            if (isset($rights['min'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_RIGHTS, $rights['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rights['max'])) {
                $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_RIGHTS, $rights['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_RIGHTS, $rights, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Note object
     *
     * @param \EcclesiaCRM\Note|ObjectCollection $note The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterByNote($note, $comparison = null)
    {
        if ($note instanceof \EcclesiaCRM\Note) {
            return $this
                ->addUsingAlias(NoteShareTableMap::COL_NTE_SH_NOTE_ID, $note->getId(), $comparison);
        } elseif ($note instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NoteShareTableMap::COL_NTE_SH_NOTE_ID, $note->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNote() only accepts arguments of type \EcclesiaCRM\Note or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Note relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function joinNote($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Note');

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
            $this->addJoinObject($join, 'Note');
        }

        return $this;
    }

    /**
     * Use the Note relation Note object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\NoteQuery A secondary query class using the current class as primary query
     */
    public function useNoteQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Note', '\EcclesiaCRM\NoteQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Family object
     *
     * @param \EcclesiaCRM\Family|ObjectCollection $family The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterByFamily($family, $comparison = null)
    {
        if ($family instanceof \EcclesiaCRM\Family) {
            return $this
                ->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_FAMILY_ID, $family->getId(), $comparison);
        } elseif ($family instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_FAMILY_ID, $family->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFamily() only accepts arguments of type \EcclesiaCRM\Family or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Family relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function joinFamily($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Family');

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
            $this->addJoinObject($join, 'Family');
        }

        return $this;
    }

    /**
     * Use the Family relation Family object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\FamilyQuery A secondary query class using the current class as primary query
     */
    public function useFamilyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFamily($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Family', '\EcclesiaCRM\FamilyQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Person object
     *
     * @param \EcclesiaCRM\Person|ObjectCollection $person The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNoteShareQuery The current query, for fluid interface
     */
    public function filterByPerson($person, $comparison = null)
    {
        if ($person instanceof \EcclesiaCRM\Person) {
            return $this
                ->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_PERSON_ID, $person->getId(), $comparison);
        } elseif ($person instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NoteShareTableMap::COL_NTE_SH_SHARE_TO_PERSON_ID, $person->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function joinPerson($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function usePersonQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Person', '\EcclesiaCRM\PersonQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildNoteShare $noteShare Object to remove from the list of results
     *
     * @return $this|ChildNoteShareQuery The current query, for fluid interface
     */
    public function prune($noteShare = null)
    {
        if ($noteShare) {
            $this->addUsingAlias(NoteShareTableMap::COL_NTE_SH_ID, $noteShare->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the note_nte_share table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NoteShareTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NoteShareTableMap::clearInstancePool();
            NoteShareTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NoteShareTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NoteShareTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NoteShareTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NoteShareTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // NoteShareQuery
