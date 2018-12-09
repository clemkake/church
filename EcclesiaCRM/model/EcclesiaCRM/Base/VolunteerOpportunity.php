<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\PersonVolunteerOpportunity as ChildPersonVolunteerOpportunity;
use EcclesiaCRM\PersonVolunteerOpportunityQuery as ChildPersonVolunteerOpportunityQuery;
use EcclesiaCRM\VolunteerOpportunity as ChildVolunteerOpportunity;
use EcclesiaCRM\VolunteerOpportunityQuery as ChildVolunteerOpportunityQuery;
use EcclesiaCRM\Map\PersonVolunteerOpportunityTableMap;
use EcclesiaCRM\Map\VolunteerOpportunityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'volunteeropportunity_vol' table.
 *
 * This contains the names and descriptions of volunteer opportunities
 *
 * @package    propel.generator.EcclesiaCRM.Base
 */
abstract class VolunteerOpportunity implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\EcclesiaCRM\\Map\\VolunteerOpportunityTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the vol_id field.
     *
     * @var        int
     */
    protected $vol_id;

    /**
     * The value for the vol_order field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $vol_order;

    /**
     * The value for the vol_active field.
     *
     * Note: this column has a database default value of: 'true'
     * @var        string
     */
    protected $vol_active;

    /**
     * The value for the vol_name field.
     *
     * @var        string
     */
    protected $vol_name;

    /**
     * The value for the vol_description field.
     *
     * @var        string
     */
    protected $vol_description;

    /**
     * @var        ObjectCollection|ChildPersonVolunteerOpportunity[] Collection to store aggregation of ChildPersonVolunteerOpportunity objects.
     */
    protected $collPersonVolunteerOpportunities;
    protected $collPersonVolunteerOpportunitiesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPersonVolunteerOpportunity[]
     */
    protected $personVolunteerOpportunitiesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->vol_order = 0;
        $this->vol_active = 'true';
    }

    /**
     * Initializes internal state of EcclesiaCRM\Base\VolunteerOpportunity object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>VolunteerOpportunity</code> instance.  If
     * <code>obj</code> is an instance of <code>VolunteerOpportunity</code>, delegates to
     * <code>equals(VolunteerOpportunity)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|VolunteerOpportunity The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [vol_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->vol_id;
    }

    /**
     * Get the [vol_order] column value.
     *
     * @return int
     */
    public function getOrder()
    {
        return $this->vol_order;
    }

    /**
     * Get the [vol_active] column value.
     *
     * @return string
     */
    public function getActive()
    {
        return $this->vol_active;
    }

    /**
     * Get the [vol_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->vol_name;
    }

    /**
     * Get the [vol_description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->vol_description;
    }

    /**
     * Set the value of [vol_id] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\VolunteerOpportunity The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->vol_id !== $v) {
            $this->vol_id = $v;
            $this->modifiedColumns[VolunteerOpportunityTableMap::COL_VOL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [vol_order] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\VolunteerOpportunity The current object (for fluent API support)
     */
    public function setOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->vol_order !== $v) {
            $this->vol_order = $v;
            $this->modifiedColumns[VolunteerOpportunityTableMap::COL_VOL_ORDER] = true;
        }

        return $this;
    } // setOrder()

    /**
     * Set the value of [vol_active] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\VolunteerOpportunity The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->vol_active !== $v) {
            $this->vol_active = $v;
            $this->modifiedColumns[VolunteerOpportunityTableMap::COL_VOL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

    /**
     * Set the value of [vol_name] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\VolunteerOpportunity The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->vol_name !== $v) {
            $this->vol_name = $v;
            $this->modifiedColumns[VolunteerOpportunityTableMap::COL_VOL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [vol_description] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\VolunteerOpportunity The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->vol_description !== $v) {
            $this->vol_description = $v;
            $this->modifiedColumns[VolunteerOpportunityTableMap::COL_VOL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->vol_order !== 0) {
                return false;
            }

            if ($this->vol_active !== 'true') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VolunteerOpportunityTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vol_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VolunteerOpportunityTableMap::translateFieldName('Order', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vol_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VolunteerOpportunityTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vol_active = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : VolunteerOpportunityTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vol_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : VolunteerOpportunityTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vol_description = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = VolunteerOpportunityTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\EcclesiaCRM\\VolunteerOpportunity'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolunteerOpportunityTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVolunteerOpportunityQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPersonVolunteerOpportunities = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see VolunteerOpportunity::setDeleted()
     * @see VolunteerOpportunity::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolunteerOpportunityTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVolunteerOpportunityQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolunteerOpportunityTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                VolunteerOpportunityTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->personVolunteerOpportunitiesScheduledForDeletion !== null) {
                if (!$this->personVolunteerOpportunitiesScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\PersonVolunteerOpportunityQuery::create()
                        ->filterByPrimaryKeys($this->personVolunteerOpportunitiesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->personVolunteerOpportunitiesScheduledForDeletion = null;
                }
            }

            if ($this->collPersonVolunteerOpportunities !== null) {
                foreach ($this->collPersonVolunteerOpportunities as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[VolunteerOpportunityTableMap::COL_VOL_ID] = true;
        if (null !== $this->vol_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VolunteerOpportunityTableMap::COL_VOL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'vol_ID';
        }
        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'vol_Order';
        }
        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'vol_Active';
        }
        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'vol_Name';
        }
        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'vol_Description';
        }

        $sql = sprintf(
            'INSERT INTO volunteeropportunity_vol (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'vol_ID':
                        $stmt->bindValue($identifier, $this->vol_id, PDO::PARAM_INT);
                        break;
                    case 'vol_Order':
                        $stmt->bindValue($identifier, $this->vol_order, PDO::PARAM_INT);
                        break;
                    case 'vol_Active':
                        $stmt->bindValue($identifier, $this->vol_active, PDO::PARAM_STR);
                        break;
                    case 'vol_Name':
                        $stmt->bindValue($identifier, $this->vol_name, PDO::PARAM_STR);
                        break;
                    case 'vol_Description':
                        $stmt->bindValue($identifier, $this->vol_description, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VolunteerOpportunityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getOrder();
                break;
            case 2:
                return $this->getActive();
                break;
            case 3:
                return $this->getName();
                break;
            case 4:
                return $this->getDescription();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['VolunteerOpportunity'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['VolunteerOpportunity'][$this->hashCode()] = true;
        $keys = VolunteerOpportunityTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getOrder(),
            $keys[2] => $this->getActive(),
            $keys[3] => $this->getName(),
            $keys[4] => $this->getDescription(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPersonVolunteerOpportunities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'personVolunteerOpportunities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'person2volunteeropp_p2vos';
                        break;
                    default:
                        $key = 'PersonVolunteerOpportunities';
                }

                $result[$key] = $this->collPersonVolunteerOpportunities->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\EcclesiaCRM\VolunteerOpportunity
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VolunteerOpportunityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\EcclesiaCRM\VolunteerOpportunity
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setOrder($value);
                break;
            case 2:
                $this->setActive($value);
                break;
            case 3:
                $this->setName($value);
                break;
            case 4:
                $this->setDescription($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = VolunteerOpportunityTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOrder($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setActive($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDescription($arr[$keys[4]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\EcclesiaCRM\VolunteerOpportunity The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(VolunteerOpportunityTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_ID)) {
            $criteria->add(VolunteerOpportunityTableMap::COL_VOL_ID, $this->vol_id);
        }
        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_ORDER)) {
            $criteria->add(VolunteerOpportunityTableMap::COL_VOL_ORDER, $this->vol_order);
        }
        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_ACTIVE)) {
            $criteria->add(VolunteerOpportunityTableMap::COL_VOL_ACTIVE, $this->vol_active);
        }
        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_NAME)) {
            $criteria->add(VolunteerOpportunityTableMap::COL_VOL_NAME, $this->vol_name);
        }
        if ($this->isColumnModified(VolunteerOpportunityTableMap::COL_VOL_DESCRIPTION)) {
            $criteria->add(VolunteerOpportunityTableMap::COL_VOL_DESCRIPTION, $this->vol_description);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildVolunteerOpportunityQuery::create();
        $criteria->add(VolunteerOpportunityTableMap::COL_VOL_ID, $this->vol_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (vol_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \EcclesiaCRM\VolunteerOpportunity (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setOrder($this->getOrder());
        $copyObj->setActive($this->getActive());
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPersonVolunteerOpportunities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPersonVolunteerOpportunity($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \EcclesiaCRM\VolunteerOpportunity Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('PersonVolunteerOpportunity' == $relationName) {
            $this->initPersonVolunteerOpportunities();
            return;
        }
    }

    /**
     * Clears out the collPersonVolunteerOpportunities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPersonVolunteerOpportunities()
     */
    public function clearPersonVolunteerOpportunities()
    {
        $this->collPersonVolunteerOpportunities = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPersonVolunteerOpportunities collection loaded partially.
     */
    public function resetPartialPersonVolunteerOpportunities($v = true)
    {
        $this->collPersonVolunteerOpportunitiesPartial = $v;
    }

    /**
     * Initializes the collPersonVolunteerOpportunities collection.
     *
     * By default this just sets the collPersonVolunteerOpportunities collection to an empty array (like clearcollPersonVolunteerOpportunities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPersonVolunteerOpportunities($overrideExisting = true)
    {
        if (null !== $this->collPersonVolunteerOpportunities && !$overrideExisting) {
            return;
        }

        $collectionClassName = PersonVolunteerOpportunityTableMap::getTableMap()->getCollectionClassName();

        $this->collPersonVolunteerOpportunities = new $collectionClassName;
        $this->collPersonVolunteerOpportunities->setModel('\EcclesiaCRM\PersonVolunteerOpportunity');
    }

    /**
     * Gets an array of ChildPersonVolunteerOpportunity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVolunteerOpportunity is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPersonVolunteerOpportunity[] List of ChildPersonVolunteerOpportunity objects
     * @throws PropelException
     */
    public function getPersonVolunteerOpportunities(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPersonVolunteerOpportunitiesPartial && !$this->isNew();
        if (null === $this->collPersonVolunteerOpportunities || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPersonVolunteerOpportunities) {
                // return empty collection
                $this->initPersonVolunteerOpportunities();
            } else {
                $collPersonVolunteerOpportunities = ChildPersonVolunteerOpportunityQuery::create(null, $criteria)
                    ->filterByVolunteerOpportunity($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPersonVolunteerOpportunitiesPartial && count($collPersonVolunteerOpportunities)) {
                        $this->initPersonVolunteerOpportunities(false);

                        foreach ($collPersonVolunteerOpportunities as $obj) {
                            if (false == $this->collPersonVolunteerOpportunities->contains($obj)) {
                                $this->collPersonVolunteerOpportunities->append($obj);
                            }
                        }

                        $this->collPersonVolunteerOpportunitiesPartial = true;
                    }

                    return $collPersonVolunteerOpportunities;
                }

                if ($partial && $this->collPersonVolunteerOpportunities) {
                    foreach ($this->collPersonVolunteerOpportunities as $obj) {
                        if ($obj->isNew()) {
                            $collPersonVolunteerOpportunities[] = $obj;
                        }
                    }
                }

                $this->collPersonVolunteerOpportunities = $collPersonVolunteerOpportunities;
                $this->collPersonVolunteerOpportunitiesPartial = false;
            }
        }

        return $this->collPersonVolunteerOpportunities;
    }

    /**
     * Sets a collection of ChildPersonVolunteerOpportunity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $personVolunteerOpportunities A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVolunteerOpportunity The current object (for fluent API support)
     */
    public function setPersonVolunteerOpportunities(Collection $personVolunteerOpportunities, ConnectionInterface $con = null)
    {
        /** @var ChildPersonVolunteerOpportunity[] $personVolunteerOpportunitiesToDelete */
        $personVolunteerOpportunitiesToDelete = $this->getPersonVolunteerOpportunities(new Criteria(), $con)->diff($personVolunteerOpportunities);


        $this->personVolunteerOpportunitiesScheduledForDeletion = $personVolunteerOpportunitiesToDelete;

        foreach ($personVolunteerOpportunitiesToDelete as $personVolunteerOpportunityRemoved) {
            $personVolunteerOpportunityRemoved->setVolunteerOpportunity(null);
        }

        $this->collPersonVolunteerOpportunities = null;
        foreach ($personVolunteerOpportunities as $personVolunteerOpportunity) {
            $this->addPersonVolunteerOpportunity($personVolunteerOpportunity);
        }

        $this->collPersonVolunteerOpportunities = $personVolunteerOpportunities;
        $this->collPersonVolunteerOpportunitiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PersonVolunteerOpportunity objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PersonVolunteerOpportunity objects.
     * @throws PropelException
     */
    public function countPersonVolunteerOpportunities(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPersonVolunteerOpportunitiesPartial && !$this->isNew();
        if (null === $this->collPersonVolunteerOpportunities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPersonVolunteerOpportunities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPersonVolunteerOpportunities());
            }

            $query = ChildPersonVolunteerOpportunityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVolunteerOpportunity($this)
                ->count($con);
        }

        return count($this->collPersonVolunteerOpportunities);
    }

    /**
     * Method called to associate a ChildPersonVolunteerOpportunity object to this object
     * through the ChildPersonVolunteerOpportunity foreign key attribute.
     *
     * @param  ChildPersonVolunteerOpportunity $l ChildPersonVolunteerOpportunity
     * @return $this|\EcclesiaCRM\VolunteerOpportunity The current object (for fluent API support)
     */
    public function addPersonVolunteerOpportunity(ChildPersonVolunteerOpportunity $l)
    {
        if ($this->collPersonVolunteerOpportunities === null) {
            $this->initPersonVolunteerOpportunities();
            $this->collPersonVolunteerOpportunitiesPartial = true;
        }

        if (!$this->collPersonVolunteerOpportunities->contains($l)) {
            $this->doAddPersonVolunteerOpportunity($l);

            if ($this->personVolunteerOpportunitiesScheduledForDeletion and $this->personVolunteerOpportunitiesScheduledForDeletion->contains($l)) {
                $this->personVolunteerOpportunitiesScheduledForDeletion->remove($this->personVolunteerOpportunitiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPersonVolunteerOpportunity $personVolunteerOpportunity The ChildPersonVolunteerOpportunity object to add.
     */
    protected function doAddPersonVolunteerOpportunity(ChildPersonVolunteerOpportunity $personVolunteerOpportunity)
    {
        $this->collPersonVolunteerOpportunities[]= $personVolunteerOpportunity;
        $personVolunteerOpportunity->setVolunteerOpportunity($this);
    }

    /**
     * @param  ChildPersonVolunteerOpportunity $personVolunteerOpportunity The ChildPersonVolunteerOpportunity object to remove.
     * @return $this|ChildVolunteerOpportunity The current object (for fluent API support)
     */
    public function removePersonVolunteerOpportunity(ChildPersonVolunteerOpportunity $personVolunteerOpportunity)
    {
        if ($this->getPersonVolunteerOpportunities()->contains($personVolunteerOpportunity)) {
            $pos = $this->collPersonVolunteerOpportunities->search($personVolunteerOpportunity);
            $this->collPersonVolunteerOpportunities->remove($pos);
            if (null === $this->personVolunteerOpportunitiesScheduledForDeletion) {
                $this->personVolunteerOpportunitiesScheduledForDeletion = clone $this->collPersonVolunteerOpportunities;
                $this->personVolunteerOpportunitiesScheduledForDeletion->clear();
            }
            $this->personVolunteerOpportunitiesScheduledForDeletion[]= $personVolunteerOpportunity;
            $personVolunteerOpportunity->setVolunteerOpportunity(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this VolunteerOpportunity is new, it will return
     * an empty collection; or if this VolunteerOpportunity has previously
     * been saved, it will retrieve related PersonVolunteerOpportunities from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in VolunteerOpportunity.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPersonVolunteerOpportunity[] List of ChildPersonVolunteerOpportunity objects
     */
    public function getPersonVolunteerOpportunitiesJoinPerson(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPersonVolunteerOpportunityQuery::create(null, $criteria);
        $query->joinWith('Person', $joinBehavior);

        return $this->getPersonVolunteerOpportunities($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->vol_id = null;
        $this->vol_order = null;
        $this->vol_active = null;
        $this->vol_name = null;
        $this->vol_description = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collPersonVolunteerOpportunities) {
                foreach ($this->collPersonVolunteerOpportunities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPersonVolunteerOpportunities = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VolunteerOpportunityTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
